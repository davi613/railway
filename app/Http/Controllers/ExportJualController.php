<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jual;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportJualController extends Controller
{
    public function exportPDF()
    {
        $jual = Jual::with('obat')->get(); // pastikan relasi `obat()` ada di model Jual
        
        // Hitung total subtotal
        $totalSubtotal = $jual->sum('subtotal');
        
        // Kirim data jual dan totalSubtotal ke view
        $pdf = Pdf::loadView('laporan.jual', compact('jual', 'totalSubtotal'))
                  ->setPaper('A4', 'portrait');

        return $pdf->download('laporan_jual-kasir.pdf');
    }
}
