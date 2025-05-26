<?php

namespace App\Http\Controllers;
// app/Http/Controllers/StokObatController.php

use Illuminate\Http\Request;
use App\Models\Obat;

class StokObatController extends Controller
{
    public function index()
    {
        $obat = Obat::with('JenisObat')->get();
        return view('stok_obat.index', compact('obat'),[
            'title' => 'Karyawan'
        ]);
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('stok_obat.edit', compact('obat'),[
            'title' => 'Karyawan'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'harga_jual' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update([
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
        ]);

        return redirect()->route('stok_obat.index')->with('success', 'Harga dan stok berhasil diperbarui.');
    }
}
