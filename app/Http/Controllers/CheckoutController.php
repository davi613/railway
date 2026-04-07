<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\JenisPengiriman;
use App\Models\MetodeBayar;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Services\MidtransService;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    // ============================================================
    // INDEX — tampilkan halaman checkout
    // ============================================================
    public function index()
    {
        $idPelanggan = auth('pelanggan')->id();

        $cartItems = Keranjang::with('obat.jenisObat')
            ->where('id_pelanggan', $idPelanggan)
            ->get();

        $hasObatKeras = $cartItems->contains(function ($item) {
            return $item->obat->jenisObat->kategori === 'Obat Keras';
        });

        $metodeBayar     = MetodeBayar::all();
        $jenisPengiriman = JenisPengiriman::all();
        $subtotal        = $cartItems->sum('subtotal');
        $biayaApp        = $subtotal > 0 ? 5000 : 0;
        $total           = $subtotal + $biayaApp;

        return view('checkout.index', compact(
            'cartItems',
            'hasObatKeras',
            'metodeBayar',
            'jenisPengiriman',
            'subtotal',
            'biayaApp',
            'total'
        ), [
            'title' => 'Checkout'
        ]);
    }

    // ============================================================
    // STORE — proses checkout:
    //   1. Validasi input
    //   2. Dapatkan snap token dari Midtrans
    //   3. Simpan semua data checkout ke SESSION (cart snapshot, detail order)
    //   4. Kembalikan snap_token ke halaman (untuk Snap.js popup — TIDAK redirect)
    //   5. Penjualan BARU dibuat via endpoint /checkout/create-order
    //      yang dipanggil dari JS callback onSuccess/onPending Snap
    // ============================================================
    public function store(Request $request)
    {
        $idPelanggan = auth('pelanggan')->id();

        // Validasi wajib resep untuk obat keras
        if ($request->has_obat_keras === 'true' && !$request->hasFile('file_resep')) {
            return back()->withErrors(['file_resep' => 'Resep dokter wajib diunggah untuk obat keras.'])->withInput();
        }

        $validator = Validator::make($request->all(), [
            'id_metode_bayar' => 'required|exists:metode_bayar,id',
            'id_jenis_kirim'  => 'required|exists:jenis_pengiriman,id',
            'file_resep'      => 'required_if:has_obat_keras,true|image|mimes:jpeg,png,jpg|max:2048|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $cartItems = Keranjang::with('obat')
            ->where('id_pelanggan', $idPelanggan)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja Anda kosong.');
        }

        $subtotal        = $cartItems->sum('subtotal');
        $biayaApp        = $subtotal > 0 ? 5000 : 0;
        $jenisPengiriman = JenisPengiriman::findOrFail($request->id_jenis_kirim);
        $ongkosKirim     = $jenisPengiriman->ongkos_kirim;
        $totalBayar      = $subtotal + $ongkosKirim + $biayaApp;

        // Simpan file resep
        $urlResep = null;
        if ($request->hasFile('file_resep')) {
            $file     = $request->file('file_resep');
            $path     = $file->store('resep', 'public');
            $urlResep = 'storage/' . $path;
        }

        // Generate order ID sementara (belum terkait penjualan)
        $tempOrderId = 'ORDER-' . $idPelanggan . '-' . time() . '-' . Str::random(4);

        // Siapkan parameter Midtrans
        $customer = auth('pelanggan')->user();

        $params = [
            'transaction_details' => [
                'order_id'     => $tempOrderId,
                'gross_amount' => $totalBayar,
            ],
            'customer_details' => [
                'first_name' => $customer->nama_pelanggan,
                'email'      => $customer->email,
                'phone'      => $customer->no_telp,
            ],
            'item_details'     => [],
            'enabled_payments' => [
                'bca_va', 'bni_va', 'bri_va', 'permata_va',
            ],
        ];

        foreach ($cartItems as $item) {
            $params['item_details'][] = [
                'id'       => $item->id_obat,
                'price'    => $item->harga,
                'quantity' => $item->jumlah_order,
                'name'     => $item->obat->nama_obat,
            ];
        }

        if ($ongkosKirim > 0) {
            $params['item_details'][] = [
                'id' => 'SHIPPING', 'price' => $ongkosKirim,
                'quantity' => 1, 'name' => 'Ongkos Kirim',
            ];
        }

        if ($biayaApp > 0) {
            $params['item_details'][] = [
                'id' => 'FEE', 'price' => $biayaApp,
                'quantity' => 1, 'name' => 'Biaya Aplikasi',
            ];
        }

        try {
            // Dapatkan Snap Token (belum membuat penjualan)
            $snapToken = $this->midtransService->getSnapToken($params);

            // Simpan data checkout ke session — penjualan BELUM dibuat
            session([
                'checkout_pending' => [
                    'temp_order_id'   => $tempOrderId,
                    'id_pelanggan'    => $idPelanggan,
                    'id_metode_bayar' => $request->id_metode_bayar,
                    'id_jenis_kirim'  => $request->id_jenis_kirim,
                    'subtotal'        => $subtotal,
                    'biaya_app'       => $biayaApp,
                    'ongkos_kirim'    => $ongkosKirim,
                    'total_bayar'     => $totalBayar,
                    'url_resep'       => $urlResep,
                    'snap_token'      => $snapToken,
                    'cart_snapshot'   => $cartItems->map(function ($item) {
                        return [
                            'id_obat'      => $item->id_obat,
                            'jumlah_order' => $item->jumlah_order,
                            'harga'        => $item->harga,
                            'subtotal'     => $item->subtotal,
                        ];
                    })->toArray(),
                ]
            ]);

            // Kembalikan snap_token ke view (halaman tidak redirect, Snap popup di JS)
            return back()->with('snap_token', $snapToken);

        } catch (\Exception $e) {
            Log::error('Checkout store error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Pembayaran gagal dimulai: ' . $e->getMessage());
        }
    }

    // ============================================================
    // CREATE ORDER — dipanggil via AJAX dari JS callback Snap
    //   setelah pembayaran berhasil (onSuccess / onPending).
    //   Membuat record penjualan berdasarkan data session.
    // ============================================================
    public function createOrder(Request $request)
    {
        $orderId           = $request->input('order_id');
        $transactionStatus = $request->input('transaction_status');
        $fraudStatus       = $request->input('fraud_status');

        Log::info('createOrder called', [
            'order_id'           => $orderId,
            'transaction_status' => $transactionStatus,
            'fraud_status'       => $fraudStatus,
        ]);

        $pending = session('checkout_pending');

        if (!$pending) {
            Log::warning('createOrder: no checkout_pending session found');
            return response()->json([
                'status'   => 'error',
                'message'  => 'Session checkout tidak ditemukan.',
                'redirect' => route('pesanan.index'),
            ]);
        }

        // Validasi order_id cocok dengan session
        if ($pending['temp_order_id'] !== $orderId) {
            Log::warning('createOrder: order_id mismatch', [
                'session_order_id' => $pending['temp_order_id'],
                'received_order_id' => $orderId,
            ]);
            return response()->json([
                'status'   => 'error',
                'message'  => 'Order ID tidak cocok.',
                'redirect' => route('pesanan.index'),
            ]);
        }

        // Cek apakah sudah pernah dibuat (hindari duplikat)
        $existing = Penjualan::where('transaction_id', $orderId)->first();
        if ($existing) {
            session()->forget('checkout_pending');
            return response()->json([
                'status'   => 'success',
                'message'  => 'Pesanan sudah dibuat sebelumnya.',
                'redirect' => route('pesanan.index'),
            ]);
        }

        DB::beginTransaction();
        try {
            // Buat record penjualan
            $penjualan = Penjualan::create([
                'id_metode_bayar'    => $pending['id_metode_bayar'],
                'id_jenis_kirim'     => $pending['id_jenis_kirim'],
                'tgl_penjualan'      => now(),
                'url_resep'          => $pending['url_resep'],
                'ongkos_kirim'       => $pending['ongkos_kirim'],
                'biaya_app'          => $pending['biaya_app'],
                'total_bayar'        => $pending['total_bayar'],
                'status_order'       => 'Menunggu Konfirmasi',
                'id_pelanggan'       => $pending['id_pelanggan'],
                'snap_token'         => $pending['snap_token'],
                'transaction_id'     => $orderId,
                'transaction_status' => $transactionStatus,
            ]);

            // Simpan detail penjualan dan kurangi stok
            foreach ($pending['cart_snapshot'] as $item) {
                DetailPenjualan::create([
                    'id_penjualan' => $penjualan->id,
                    'id_obat'      => $item['id_obat'],
                    'jumlah_beli'  => $item['jumlah_order'],
                    'harga_beli'   => $item['harga'],
                    'subtotal'     => $item['subtotal'],
                ]);

                $obat = \App\Models\Obat::find($item['id_obat']);
                if ($obat) {
                    $obat->stok -= $item['jumlah_order'];
                    $obat->save();
                }
            }

            // Kosongkan keranjang
            Keranjang::where('id_pelanggan', $pending['id_pelanggan'])->delete();

            // Bersihkan session pending
            session()->forget('checkout_pending');

            DB::commit();

            Log::info('Penjualan created via createOrder', [
                'penjualan_id' => $penjualan->id,
                'order_id'     => $orderId,
            ]);

            return response()->json([
                'status'   => 'success',
                'message'  => 'Pembayaran berhasil! Pesanan Anda sedang diproses.',
                'redirect' => route('pesanan.index'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating penjualan in createOrder: ' . $e->getMessage());
            return response()->json([
                'status'   => 'error',
                'message'  => 'Pembayaran diterima namun terjadi kesalahan sistem. Hubungi admin.',
                'redirect' => route('pesanan.index'),
            ]);
        }
    }

    // ============================================================
    // FINISH — callback dari Midtrans setelah proses pembayaran.
    //   Digunakan sebagai FALLBACK jika JS callback gagal.
    //   Hanya buat penjualan jika status pembayaran success/settlement.
    // ============================================================
    public function finish(Request $request)
    {
        $orderId           = $request->query('order_id');
        $transactionStatus = $request->query('transaction_status');
        $fraudStatus       = $request->query('fraud_status');

        Log::info('Midtrans finish callback', [
            'order_id'           => $orderId,
            'transaction_status' => $transactionStatus,
            'fraud_status'       => $fraudStatus,
        ]);

        // Ambil data pending dari session
        $pending = session('checkout_pending');

        // Cek apakah transaksi BENAR-BENAR berhasil (settlement atau capture + accept)
        $isSuccess = ($transactionStatus === 'settlement') ||
                     ($transactionStatus === 'capture' && $fraudStatus === 'accept');

        if ($isSuccess && $pending && isset($pending['temp_order_id']) && $pending['temp_order_id'] === $orderId) {
            // Cek apakah sudah pernah dibuat (hindari duplikat)
            $existing = Penjualan::where('transaction_id', $orderId)->first();

            if (!$existing) {
                DB::beginTransaction();
                try {
                    // BARU SEKARANG buat record penjualan
                    $penjualan = Penjualan::create([
                        'id_metode_bayar'    => $pending['id_metode_bayar'],
                        'id_jenis_kirim'     => $pending['id_jenis_kirim'],
                        'tgl_penjualan'      => now(),
                        'url_resep'          => $pending['url_resep'],
                        'ongkos_kirim'       => $pending['ongkos_kirim'],
                        'biaya_app'          => $pending['biaya_app'],
                        'total_bayar'        => $pending['total_bayar'],
                        'status_order'       => 'Menunggu Konfirmasi',
                        'id_pelanggan'       => $pending['id_pelanggan'],
                        'snap_token'         => $pending['snap_token'],
                        'transaction_id'     => $orderId,
                        'transaction_status' => $transactionStatus,
                    ]);

                    // Simpan detail penjualan dan kurangi stok
                    foreach ($pending['cart_snapshot'] as $item) {
                        DetailPenjualan::create([
                            'id_penjualan' => $penjualan->id,
                            'id_obat'      => $item['id_obat'],
                            'jumlah_beli'  => $item['jumlah_order'],
                            'harga_beli'   => $item['harga'],
                            'subtotal'     => $item['subtotal'],
                        ]);

                        $obat = \App\Models\Obat::find($item['id_obat']);
                        if ($obat) {
                            $obat->stok -= $item['jumlah_order'];
                            $obat->save();
                        }
                    }

                    // Kosongkan keranjang
                    Keranjang::where('id_pelanggan', $pending['id_pelanggan'])->delete();

                    // Bersihkan session pending
                    session()->forget('checkout_pending');

                    DB::commit();

                    Log::info('Penjualan created after payment success (finish callback)', [
                        'penjualan_id' => $penjualan->id,
                        'order_id'     => $orderId,
                    ]);

                    return redirect()->route('pesanan.index')
                        ->with('success', 'Pembayaran berhasil! Pesanan Anda sedang diproses.');

                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error('Error creating penjualan after payment: ' . $e->getMessage());
                    return redirect()->route('pesanan.index')
                        ->with('error', 'Pembayaran diterima namun terjadi kesalahan sistem. Hubungi admin.');
                }
            } else {
                // Sudah pernah dibuat (refresh halaman / double callback)
                session()->forget('checkout_pending');
                return redirect()->route('pesanan.index')
                    ->with('success', 'Pembayaran sudah dikonfirmasi sebelumnya.');
            }
        }

        // Pembayaran pending
        if ($transactionStatus === 'pending') {
            // Jika belum ada penjualan dan ada pending session, buat dulu
            $existing = Penjualan::where('transaction_id', $orderId)->first();
            if (!$existing && $pending && isset($pending['temp_order_id']) && $pending['temp_order_id'] === $orderId) {
                DB::beginTransaction();
                try {
                    $penjualan = Penjualan::create([
                        'id_metode_bayar'    => $pending['id_metode_bayar'],
                        'id_jenis_kirim'     => $pending['id_jenis_kirim'],
                        'tgl_penjualan'      => now(),
                        'url_resep'          => $pending['url_resep'],
                        'ongkos_kirim'       => $pending['ongkos_kirim'],
                        'biaya_app'          => $pending['biaya_app'],
                        'total_bayar'        => $pending['total_bayar'],
                        'status_order'       => 'Menunggu Konfirmasi',
                        'id_pelanggan'       => $pending['id_pelanggan'],
                        'snap_token'         => $pending['snap_token'],
                        'transaction_id'     => $orderId,
                        'transaction_status' => 'pending',
                    ]);

                    foreach ($pending['cart_snapshot'] as $item) {
                        DetailPenjualan::create([
                            'id_penjualan' => $penjualan->id,
                            'id_obat'      => $item['id_obat'],
                            'jumlah_beli'  => $item['jumlah_order'],
                            'harga_beli'   => $item['harga'],
                            'subtotal'     => $item['subtotal'],
                        ]);

                        $obat = \App\Models\Obat::find($item['id_obat']);
                        if ($obat) {
                            $obat->stok -= $item['jumlah_order'];
                            $obat->save();
                        }
                    }

                    Keranjang::where('id_pelanggan', $pending['id_pelanggan'])->delete();
                    session()->forget('checkout_pending');
                    DB::commit();

                    Log::info('Penjualan created for pending payment', [
                        'penjualan_id' => $penjualan->id,
                        'order_id'     => $orderId,
                    ]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error('Error creating penjualan for pending: ' . $e->getMessage());
                }
            }

            return redirect()->route('pesanan.index')
                ->with('info', 'Pembayaran masih menunggu konfirmasi. Silakan selesaikan pembayaran Anda.');
        }

        // Cancel / close / error — hapus session dan kembalikan ke checkout
        session()->forget('checkout_pending');
        return redirect()->route('checkout.index')
            ->with('info', 'Pembayaran dibatalkan atau belum diselesaikan. Keranjang Anda masih tersimpan.');
    }

    // ============================================================
    // NOTIFICATION — Midtrans server-to-server webhook
    //   Ini adalah backup jika user tidak kembali ke halaman finish.
    //   Di sini update status jika record sudah ada.
    // ============================================================
    public function notification(Request $request)
    {
        try {
            $notif = new \Midtrans\Notification();

            $transaction = $notif->transaction_status;
            $type        = $notif->payment_type;
            $orderId     = $notif->order_id;
            $fraudStatus = $notif->fraud_status ?? null;

            Log::info('Midtrans notification received', [
                'order_id'   => $orderId,
                'status'     => $transaction,
                'fraud'      => $fraudStatus,
            ]);

            // Cek apakah penjualan sudah pernah dibuat untuk order ini
            $existing = Penjualan::where('transaction_id', $orderId)->first();

            // Tentukan apakah pembayaran benar-benar sukses
            $isSuccess = ($transaction === 'settlement') ||
                         ($transaction === 'capture' && $fraudStatus === 'accept');

            if ($isSuccess && !$existing) {
                // Webhook ini hanya update status jika record sudah ada via finish callback atau createOrder
                // Jika belum ada, log warning — cart snapshot tidak tersedia di webhook
                Log::warning('Midtrans notification: payment success but no penjualan record found. User may not have returned to finish callback.', [
                    'order_id' => $orderId,
                ]);
            }

            if ($existing) {
                // Update keterangan status jika record sudah ada
                if ($isSuccess) {
                    $existing->update([
                        'status_order'       => 'Menunggu Konfirmasi',
                        'transaction_status' => $transaction,
                    ]);
                } elseif ($transaction === 'deny') {
                    $existing->update([
                        'status_order'       => 'Dibatalkan Penjual',
                        'keterangan_status'  => 'Pembayaran ditolak',
                        'transaction_status' => $transaction,
                    ]);
                } elseif ($transaction === 'expire') {
                    $existing->update([
                        'status_order'       => 'Dibatalkan Pembeli',
                        'keterangan_status'  => 'Pembayaran kedaluwarsa',
                        'transaction_status' => $transaction,
                    ]);
                } elseif ($transaction === 'cancel') {
                    $existing->update([
                        'status_order'       => 'Dibatalkan Pembeli',
                        'keterangan_status'  => 'Pembayaran dibatalkan',
                        'transaction_status' => $transaction,
                    ]);
                }
            }

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            Log::error('Midtrans notification error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}