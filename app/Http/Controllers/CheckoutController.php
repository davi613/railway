<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\JenisPengiriman;
use App\Models\MetodeBayar;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\MidtransService;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function index()
    {
        $idPelanggan = auth('pelanggan')->id();

        $cartItems = Keranjang::with('obat.jenisObat')
            ->where('id_pelanggan', $idPelanggan)
            ->get();

        $hasObatKeras = $cartItems->contains(function ($item) {
            return $item->obat->jenisObat->kategori === 'Obat Keras';
        });

        $metodeBayar = MetodeBayar::all();
        $jenisPengiriman = JenisPengiriman::all();
        $subtotal = $cartItems->sum('subtotal');
        $biayaApp = $subtotal > 0 ? 5000 : 0;
        $total = $subtotal + $biayaApp;

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

    public function store(Request $request)
    {
        $idPelanggan = auth('pelanggan')->id();

        $validator = Validator::make($request->all(), [
            'id_metode_bayar' => 'required|exists:metode_bayar,id',
            'id_jenis_kirim' => 'required|exists:jenis_pengiriman,id',
            'file_resep' => 'required_if:has_obat_keras,true|image|mimes:jpeg,png,jpg|max:2048|nullable',
        ]);

        if ($request->has_obat_keras === 'true' && !$request->hasFile('file_resep')) {
            return back()->withErrors(['file_resep' => 'Resep dokter wajib diunggah untuk obat keras.'])->withInput();
        }


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $cartItems = Keranjang::with('obat')
            ->where('id_pelanggan', $idPelanggan)
            ->get();

        $subtotal = $cartItems->sum('subtotal');
        $biayaApp = $subtotal > 0 ? 5000 : 0;

        $jenisPengiriman = JenisPengiriman::findOrFail($request->id_jenis_kirim);
        $ongkosKirim = $jenisPengiriman->ongkos_kirim;

        $totalBayar = $subtotal + $ongkosKirim + $biayaApp;

        // Proses upload file resep jika ada
        $urlResep = null;
        if ($request->hasFile('file_resep')) {
            $file = $request->file('file_resep');
            $path = $file->store('resep', 'public');
            $urlResep = 'storage/' . $path;
        }

        // Buat transaksi di database
          $penjualan = Penjualan::create([
            'id_metode_bayar' => $request->id_metode_bayar,
            'id_jenis_kirim' => $request->id_jenis_kirim,
            'tgl_penjualan' => now(),
            'url_resep' => $urlResep,
            'ongkos_kirim' => $ongkosKirim,
            'biaya_app' => $biayaApp,
            'total_bayar' => $totalBayar,
            'status_order' => 'Menunggu Konfirmasi',
            'id_pelanggan' => $idPelanggan,
        ]);

        // Simpan detail penjualan
        foreach ($cartItems as $item) {
            DetailPenjualan::create([
                'id_penjualan' => $penjualan->id,
                'id_obat' => $item->id_obat,
                'jumlah_beli' => $item->jumlah_order,
                'harga_beli' => $item->harga,
                'subtotal' => $item->subtotal,
            ]);

            $obat = $item->obat;
            $obat->stok -= $item->jumlah_order;
            $obat->save();
        }

        // Siapkan data untuk Midtrans
        $customer = auth('pelanggan')->user();
        $orderId = 'ORDER-' . $penjualan->id . '-' . Str::random(5);
        
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalBayar,
            ],
            'customer_details' => [
                'first_name' => $customer->nama_pelanggan,
                'email' => $customer->email,
                'phone' => $customer->no_telp,
            ],
            'item_details' => [],
            'enabled_payments' => [
                'bca_va', 'bni_va', 'bri_va', 
                'permata_va',
            ],
            'callbacks' => [
                'finish' => route('checkout.finish', $penjualan->id)
            ]
        ];

        // Tambahkan item ke detail transaksi
        foreach ($cartItems as $item) {
            $params['item_details'][] = [
                'id' => $item->id_obat,
                'price' => $item->harga,
                'quantity' => $item->jumlah_order,
                'name' => $item->obat->nama_obat
            ];
        }

        // Tambahkan biaya pengiriman dan biaya aplikasi
        if ($ongkosKirim > 0) {
            $params['item_details'][] = [
                'id' => 'SHIPPING',
                'price' => $ongkosKirim,
                'quantity' => 1,
                'name' => 'Ongkos Kirim'
            ];
        }

        if ($biayaApp > 0) {
            $params['item_details'][] = [
                'id' => 'FEE',
                'price' => $biayaApp,
                'quantity' => 1,
                'name' => 'Biaya Aplikasi'
            ];
        }

        try {
            // Dapatkan Snap Token dari Midtrans
            $snapToken = $this->midtransService->getSnapToken($params);
            
            // Dapatkan payment URL
            $paymentUrl = $this->midtransService->createTransaction($params);
            
            // Update data penjualan dengan informasi Midtrans
            $penjualan->update([
                'snap_token' => $snapToken,
                'payment_url' => $paymentUrl->redirect_url,
                'transaction_id' => $orderId
            ]);

            // Kosongkan keranjang
            Keranjang::where('id_pelanggan', $idPelanggan)->delete();

            // Redirect ke halaman pembayaran Midtrans
            return redirect($paymentUrl->redirect_url);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Pembayaran gagal: ' . $e->getMessage());
        }
    }

    public function finish($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        
        return redirect()->route('pesanan.index')
            ->with('success', 'Pembayaran berhasil diproses');
    }

    public function notification(Request $request)
    {
        try {
            $notif = new \Midtrans\Notification();
            
            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $orderId = $notif->order_id;
            $fraud = $notif->fraud_status;

            // Cari transaksi berdasarkan order_id
            $penjualan = Penjualan::where('transaction_id', $orderId)->first();

            if (!$penjualan) {
                return response()->json(['status' => 'error', 'message' => 'Transaction not found']);
            }

            // Handle notification status
            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $penjualan->update(['transaction_status' => 'challenge']);
                    } else {
                        $penjualan->update(['transaction_status' => 'paid']);
                    }
                }
            } elseif ($transaction == 'settlement') {
                $penjualan->update(['transaction_status' => 'paid']);
            } elseif ($transaction == 'pending') {
                $penjualan->update(['transaction_status' => 'pending']);
            } elseif ($transaction == 'deny') {
                $penjualan->update(['transaction_status' => 'denied']);
            } elseif ($transaction == 'expire') {
                $penjualan->update(['transaction_status' => 'expired']);
            } elseif ($transaction == 'cancel') {
                $penjualan->update(['transaction_status' => 'canceled']);
            }

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}


// use App\Models\Keranjang;
// use App\Models\JenisPengiriman;
// use App\Models\MetodeBayar;
// use App\Models\Penjualan;
// use App\Models\DetailPenjualan;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

// class CheckoutController extends Controller
// {
//     public function index()
//     {
//         $idPelanggan = auth('pelanggan')->id();

//         $cartItems = Keranjang::with('obat.jenisObat')
//             ->where('id_pelanggan', $idPelanggan)
//             ->get();

//         $hasObatKeras = $cartItems->contains(function ($item) {
//             return $item->obat->jenisObat->kategori === 'Obat Keras';
//         });

//         $metodeBayar = MetodeBayar::all();
//         $jenisPengiriman = JenisPengiriman::all();
//         $subtotal = $cartItems->sum('subtotal');
//         $biayaApp = $subtotal > 0 ? 5000 : 0;
//         $total = $subtotal + $biayaApp;

//         return view('checkout.index', compact(
//             'cartItems',
//             'hasObatKeras',
//             'metodeBayar',
//             'jenisPengiriman',
//             'subtotal',
//             'biayaApp',
//             'total'
//         ), [
//             'title' => 'Checkout'
//         ]);
//     }

//     public function store(Request $request)
//     {
//         $idPelanggan = auth('pelanggan')->id();

//         $validator = Validator::make($request->all(), [
//             'id_metode_bayar' => 'required|exists:metode_bayar,id',
//             'id_jenis_kirim' => 'required|exists:jenis_pengiriman,id',
//             'file_resep' => 'required_if:has_obat_keras,true|image|mimes:jpeg,png,jpg|max:2048|nullable',
//         ]);

//         if ($validator->fails()) {
//             return redirect()->back()
//                 ->withErrors($validator)
//                 ->withInput();
//         }

//         $cartItems = Keranjang::with('obat')
//             ->where('id_pelanggan', $idPelanggan)
//             ->get();

//         $subtotal = $cartItems->sum('subtotal');
//         $biayaApp = $subtotal > 0 ? 5000 : 0;

//         $jenisPengiriman = JenisPengiriman::findOrFail($request->id_jenis_kirim);
//         $ongkosKirim = $jenisPengiriman->ongkos_kirim;

//         $totalBayar = $subtotal + $ongkosKirim + $biayaApp;

//         // Proses upload file resep jika ada
//         $urlResep = null;
//         if ($request->hasFile('file_resep')) {
//             $file = $request->file('file_resep');
//             $path = $file->store('resep', 'public');
//             $urlResep = 'storage/' . $path;
//         }

//         $penjualan = Penjualan::create([
//             'id_metode_bayar' => $request->id_metode_bayar,
//             'id_jenis_kirim' => $request->id_jenis_kirim,
//             'tgl_penjualan' => now(),
//             'url_resep' => $urlResep,
//             'ongkos_kirim' => $ongkosKirim,
//             'biaya_app' => $biayaApp,
//             'total_bayar' => $totalBayar,
//             'status_order' => 'Menunggu Konfirmasi',
//             'id_pelanggan' => $idPelanggan,
//         ]);

//         foreach ($cartItems as $item) {
//             DetailPenjualan::create([
//                 'id_penjualan' => $penjualan->id,
//                 'id_obat' => $item->id_obat,
//                 'jumlah_beli' => $item->jumlah_order,
//                 'harga_beli' => $item->harga,
//                 'subtotal' => $item->subtotal,
//             ]);

//             $obat = $item->obat;
//             $obat->stok -= $item->jumlah_order;
//             $obat->save();
//         }

//         Keranjang::where('id_pelanggan', $idPelanggan)->delete();

//         return redirect()->route('pesanan.index', $penjualan->id)
//             ->with('success', 'Pesanan berhasil dibuat! Silahkan lakukan pembayaran.');
//     }
// }
