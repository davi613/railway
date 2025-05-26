<?php

namespace App\Http\Controllers;

use App\Models\JenisObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JenisObatController extends Controller
{
    public function index()
    {
        $jenisObats = JenisObat::latest()->get();
        return view('jenis_obat.index', [
            'title' => 'Apoteker',
            'menu' => 'Master Data',
            'jenisObats' => $jenisObats
        ]);
    }

    public function create()
    {
        return view('jenis_obat.create', [
            'title' => 'Apoteker',
            'menu' => 'Master Data'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|max:100|unique:jenis_obat',
            'deskripsi_jenis' => 'nullable|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image_url');

        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('jenis_obat', 'public');
        }

        JenisObat::create($data);

        return redirect()->route('jenis_obat.index')->with('success', 'Jenis obat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jenisObat = JenisObat::findOrFail($id);
        return view('jenis_obat.edit', [
            'title' => 'Apoteker',
            'menu' => 'Master Data',
            'jenisObat' => $jenisObat
        ]);
    }

    public function update(Request $request, $id)
    {
        $jenisObat = JenisObat::findOrFail($id);
        
        $request->validate([
            'jenis' => 'required|string|max:100|unique:jenis_obat,jenis,'.$id,
            'deskripsi_jenis' => 'nullable|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image_url');

        if ($request->hasFile('image_url')) {
            // Hapus gambar lama jika ada
            if ($jenisObat->image_url) {
                Storage::disk('public')->delete($jenisObat->image_url);
            }
            $data['image_url'] = $request->file('image_url')->store('jenis_obat', 'public');
        }

        $jenisObat->update($data);

        return redirect()->route('jenis_obat.index')->with('success', 'Jenis obat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jenisObat = JenisObat::findOrFail($id);

        // Hapus gambar jika ada
        if ($jenisObat->image_url) {
            Storage::disk('public')->delete($jenisObat->image_url);
        }

        $jenisObat->delete();

        return redirect()->route('jenis_obat.index')->with('success', 'Jenis obat berhasil dihapus!');
    }
}