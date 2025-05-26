<?php
namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class LaporanJualController extends Controller
{
    public function index()
    {
        // Mengambil data penjualan yang status_order-nya 'Selesai'
        $penjualan = Penjualan::with('pelanggan')
            ->where('status_order', 'Selesai')
            ->select('id_pelanggan', 'tgl_penjualan', 'total_bayar', 'status_order')
            ->get();

        // Menghitung total penjualan berdasarkan 'id_penjualan' dan 'total_bayar'
        $totalPenjualan = $penjualan->count();  // Total transaksi
        $totalBayar = $penjualan->sum('total_bayar');  // Total pembayaran

        return view('laporan-jual.index', compact('penjualan', 'totalPenjualan', 'totalBayar'), [
            'title' => 'Pemilik'
        ]);
    }
}
