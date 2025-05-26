<?php

namespace App\Http\Controllers;

use App\Models\DetailPembelian;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanPembelianController extends Controller
{
    public function downloadPDF()
    {
        $data = DetailPembelian::with(['obat', 'pembelian'])->get();

        $pdf = Pdf::loadView('laporan.pembelian', compact('data'));
        return $pdf->download('laporan_detail_pembelian.pdf');
    }
}
