<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;

class DetailPesananController extends Controller
{
    public function show($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        // Ambil semua detail dari penjualan yang diklik
        $detail_penjualan = DetailPenjualan::where('id_penjualan', $id)
            ->with('obat')
            ->get();

        return view('detail_pesanan.show', compact('penjualan', 'detail_penjualan'),[
            'title' => 'detail_penjualan'
        ]);
    }
}
