<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Obat;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // public function show($id)
    // {
    //     try {
    //         $order = Penjualan::with([
    //                     'metodeBayar', 
    //                     'jenisPengiriman', 
    //                     'detailPenjualan.obat.jenisObat',
    //                     'pelanggan'
    //                 ])
    //                 ->where('id', $id)
    //                 ->where('id_pelanggan', auth('pelanggan')->id())
    //                 ->firstOrFail();

    //         return view('pesanan.show', compact('order'), [
    //             'title' => 'Detail Pesanan #' . $order->id,
    //         ]);
    //     } catch (\Exception $e) {
    //         return redirect()->route('pesanan.index')->with('error', 'Pesanan tidak ditemukan atau Anda tidak memiliki akses.');
    //     }
    // }

  public function index(Request $request)
{
    $query = Penjualan::with(['metodeBayar', 'jenisPengiriman'])
        ->where('id_pelanggan', auth('pelanggan')->id());

    // Filter berdasarkan status jika ada input
    if ($request->has('status') && $request->status != '') {
        $query->where('status_order', $request->status);
    }

    $orders = $query->orderBy('tgl_penjualan', 'desc')->paginate(10);

    // Kirim kembali status terpilih ke view
    return view('pesanan.index', compact('orders'), [
        'title' => 'Pesanan Saya',
        'selectedStatus' => $request->status
    ]);
}


    public function cancel(Request $request, $id)
    {
        $order = Penjualan::with('detailPenjualan.obat')
                 ->where('id', $id)
                 ->where('id_pelanggan', auth('pelanggan')->id())
                 ->firstOrFail();

        if ($order->status_order == 'Menunggu Konfirmasi') {
            // Kembalikan stok obat
            foreach ($order->detailPenjualan as $item) {
                $obat = $item->obat;
                $obat->stok += $item->jumlah_beli;
                $obat->save();
            }

            $order->update([
                'status_order' => 'Dibatalkan Pembeli',
                'keterangan_status' => 'Pesanan dibatalkan oleh pelanggan'
            ]);

            return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan');
        }

        return redirect()->back()->with('error', 'Pesanan tidak dapat dibatalkan karena sudah diproses');
    }
}