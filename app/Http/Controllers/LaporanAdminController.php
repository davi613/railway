<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Distributor;
use App\Models\JenisPengiriman;
use App\Models\MetodeBayar;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanAdminController extends Controller
{
    public function cetakPDF()
    {
        $users = User::all();
        $pelanggan = Pelanggan::all();
        $distributor = Distributor::all();
        $metodeBayar = MetodeBayar::all();
        $jenisPengiriman = JenisPengiriman::all();

        $pdf = Pdf::loadView('laporan.laporan_admin_pdf', compact(
            'users', 'pelanggan', 'distributor', 'metodeBayar', 'jenisPengiriman'
        ))->setPaper('A4', 'portrait');

        return $pdf->download('laporan-data-admin.pdf');
    }
}
