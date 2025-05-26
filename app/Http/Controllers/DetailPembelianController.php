<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPembelian;
use App\Models\Pembelian;
use App\Models\Obat;

class DetailPembelianController extends Controller
{
    public function index()
    {
        $details = DetailPembelian::with(['pembelian', 'obat'])->get();
        return view('detail_pembelian.index', [
            'title' => 'Apoteker',
            'menu' => 'Pembelian',
            'details' => $details
        ]);
    }

    public function create()
    {
        // Menyaring nota pembelian yang sudah digunakan di detail pembelian
        $usedPembelians = DetailPembelian::pluck('id_pembelian')->toArray(); // Mendapatkan id_pembelian yang sudah digunakan
        $pembelians = Pembelian::whereNotIn('id', $usedPembelians)->get(); // Mengambil nota pembelian yang belum digunakan
        $obats = Obat::all();

        return view('detail_pembelian.create', [
            'title' => 'Apoteker',
            'menu' => 'Pembelian',
            'pembelians' => $pembelians,
            'obats' => $obats
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pembelian' => 'required|exists:pembelian,id',
            'id_obat' => 'required|exists:obat,id',
            'jumlah_beli' => 'required|integer|min:1',
            'harga_beli' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0'
        ]);

        DetailPembelian::create($request->all());

        return redirect()->route('detail_pembelian.index')
            ->with('success', 'Detail pembelian berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $detail = DetailPembelian::findOrFail($id);
        $pembelians = Pembelian::all();
        $obats = Obat::all();
        return view('detail_pembelian.edit', [
            'title' => 'Apoteker',
            'menu' => 'Pembelian',
            'detail' => $detail,
            'pembelians' => $pembelians,
            'obats' => $obats
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pembelian' => 'required|exists:pembelian,id',
            'id_obat' => 'required|exists:obat,id',
            'jumlah_beli' => 'required|integer|min:1',
            'harga_beli' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0'
        ]);

        $detail = DetailPembelian::findOrFail($id);
        $detail->update($request->all());

        return redirect()->route('detail_pembelian.index')
            ->with('success', 'Detail pembelian berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $detail = DetailPembelian::findOrFail($id);
        $detail->delete();

        return redirect()->route('detail_pembelian.index')
            ->with('success', 'Detail pembelian berhasil dihapus!');
    }
}
