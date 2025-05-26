<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\DetailPembelian;

class PemilikController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();

        $totalPenjualan = Penjualan::where('status_order', 'selesai')->sum('total_bayar');

        $totalPembelian = DetailPembelian::sum('subtotal');

        return view('pemilik.index', [
            'title' => 'Pemilik',
            'totalPelanggan' => $totalPelanggan,
            'totalPenjualan' => $totalPenjualan,
            'totalPembelian' => $totalPembelian
        ]);
    }
}