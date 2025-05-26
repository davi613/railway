<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanPenjualanController extends Controller
{
    public function downloadPDF()
    {
        $data = Penjualan::with(['pelanggan', 'jenisPengiriman', 'metodeBayar'])
                ->where('status_order', 'Selesai')
                ->get();


        $pdf = Pdf::loadView('laporan.penjualan', compact('data'));
        return $pdf->download('laporan_penjualan.pdf');
    }
}
