<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use App\Models\Obat;
use Illuminate\Support\Facades\Storage;

class KonfirmasiController extends Controller
{
    public function index()
    {
        // Ambil data penjualan (digunakan untuk konfirmasi)
        $konfirmasis = Penjualan::with(['jenisPengiriman', 'pelanggan'])->get();

        return view('konfirmasi.index', compact('konfirmasis'), [
            'title' => 'Kasir'
        ]);
    }

    public function edit($id)
    {
        $konfirmasi = Penjualan::findOrFail($id);
        return view('konfirmasi.edit', compact('konfirmasi'), [
            'title' => 'Kasir'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status_order' => 'required|string',
            'keterangan_status' => 'nullable|string|max:255',
        ]);

        $konfirmasi = Penjualan::findOrFail($id);
        $konfirmasi->update($request->only('status_order', 'keterangan_status'));

        return redirect()->route('konfirmasi.index')->with('success', 'Data berhasil dikonfirmasi!');
    }

    public function destroy($id)
    {
        $konfirmasi = Penjualan::findOrFail($id);
        $konfirmasi->delete();

        return redirect()->route('konfirmasi.index')->with('success', 'Data berhasil dihapus!');
    }


     public function show($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->url_resep = Storage::exists("public/{$penjualan->url_resep}")
    ? Storage::url($penjualan->url_resep)
    : asset('img/default-resep.png');
    
        // Ambil semua detail dari penjualan yang diklik
        $detail_penjualan = DetailPenjualan::where('id_penjualan', $id)
            ->with('obat')
            ->get();

        $jenis = Obat::all();


        return view('konfirmasi.show', compact('penjualan', 'detail_penjualan','jenis'),[
            'title' => 'Kasir'
        ]);

        
    }

}
