<?php

namespace App\Http\Controllers;

use App\Models\Jual;
use Illuminate\Http\Request;

class LaporanKasirController extends Controller
{
    public function index()
    {
        $penjualan = Jual::with('obat')->latest()->paginate(10);

        $totalTransaksi = Jual::count();
        $totalNominal = Jual::sum('subtotal');

        return view('laporan_kasir.index', compact('penjualan', 'totalTransaksi', 'totalNominal'),[
            'title' => 'Pemilik'
        ]);
    }
}
