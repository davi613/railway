<?php

namespace App\Http\Controllers;
// app/Http/Controllers/ObatController.php
use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\JenisObat;
use Illuminate\Support\Facades\Storage;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::with('jenisObat')->get();
        return view('obat.index', [
            'title' => 'Apoteker',
            'menu' => 'Obat',
            'obats' => $obats
        ]);
    }

    public function create()
    {
        $jenisObats = JenisObat::all();
        return view('obat.create', [
            'title' => 'Apoteker',
            'menu' => 'Obat',
            'jenisObats' => $jenisObats
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:100',
            'idjenis' => 'required|exists:jenis_obat,id',
            'harga_jual' => 'required|integer',
            'deskripsi_obat' => 'nullable|string',
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stok' => 'required|integer',
        ]);

        $data = $request->except(['foto1', 'foto2', 'foto3']);

        // Upload foto1
        if ($request->hasFile('foto1')) {
            $data['foto1'] = $request->file('foto1')->store('foto_obat', 'public');
        }

        // Upload foto2
        if ($request->hasFile('foto2')) {
            $data['foto2'] = $request->file('foto2')->store('foto_obat', 'public');
        }

        // Upload foto3
        if ($request->hasFile('foto3')) {
            $data['foto3'] = $request->file('foto3')->store('foto_obat', 'public');
        }

        Obat::create($data);

        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        $jenisObats = JenisObat::all();
        return view('obat.edit', [
            'title' => 'Apoteker',
            'menu' => 'Obat',
            'obat' => $obat,
            'jenisObats' => $jenisObats
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:100',
            'idjenis' => 'required|exists:jenis_obat,id',
            'harga_jual' => 'required|integer',
            'deskripsi_obat' => 'nullable|string',
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stok' => 'required|integer',
        ]);

        $obat = Obat::findOrFail($id);
        $data = $request->except(['foto1', 'foto2', 'foto3']);

        // Upload foto1
        if ($request->hasFile('foto1')) {
            // Hapus foto lama jika ada
            if ($obat->foto1) {
                Storage::disk('public')->delete($obat->foto1);
            }
            $data['foto1'] = $request->file('foto1')->store('foto_obat', 'public');
        }

        // Upload foto2
        if ($request->hasFile('foto2')) {
            // Hapus foto lama jika ada
            if ($obat->foto2) {
                Storage::disk('public')->delete($obat->foto2);
            }
            $data['foto2'] = $request->file('foto2')->store('foto_obat', 'public');
        }

        // Upload foto3
        if ($request->hasFile('foto3')) {
            // Hapus foto lama jika ada
            if ($obat->foto3) {
                Storage::disk('public')->delete($obat->foto3);
            }
            $data['foto3'] = $request->file('foto3')->store('foto_obat', 'public');
        }

        $obat->update($data);

        return redirect()->route('obat.index')->with('success', 'Obat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);

        // Hapus foto jika ada
        if ($obat->foto1) {
            Storage::disk('public')->delete($obat->foto1);
        }
        if ($obat->foto2) {
            Storage::disk('public')->delete($obat->foto2);
        }
        if ($obat->foto3) {
            Storage::disk('public')->delete($obat->foto3);
        }

        $obat->delete();

        return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus!');
    }
}