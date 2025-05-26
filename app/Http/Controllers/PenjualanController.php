<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        // Ambil data penjualan beserta relasi jenis pengiriman dan pelanggan
        $penjualans = Penjualan::with(['jenisPengiriman', 'pelanggan'])->get();

        return view('penjualan.index', compact('penjualans'), [
            'title' => 'Karyawan'
        ]);
    }

    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        return view('penjualan.edit', compact('penjualan'), [
            'title' => 'Karyawan'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status_order' => 'required|string',
            'keterangan_status' => 'nullable|string|max:255',
        ]);

        $penjualan = Penjualan::findOrFail($id);
        $penjualan->update($request->only('status_order', 'keterangan_status'));

        return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil dihapus!');
    }
}
