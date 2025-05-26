<?php

namespace App\Http\Controllers;

use App\Models\JenisPengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JenisPengirimanController extends Controller
{
    public function index()
    {
        $jenisPengiriman = JenisPengiriman::all();
        return view('jenis_pengiriman.index', [
            'title' => 'Admin',
            'menu' => 'Pengiriman',
            'jenisPengiriman' => $jenisPengiriman
        ]);
    }

    public function create()
    {
        return view('jenis_pengiriman.create', [
            'title' => 'Admin',
            'menu' => 'Pengiriman'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kirim' => 'required|in:ekonomi,kargo,regular,same day,standar',
            'nama_ekspedisi' => 'required|string|max:255',
            // 'ongkos_kirim' => 'required|decimal|max:255',
            'ongkos_kirim' => 'required|integer',
            'logo_ekspedisi' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('logo_ekspedisi');

        // Upload logo ekspedisi
        if ($request->hasFile('logo_ekspedisi')) {
            $data['logo_ekspedisi'] = $request->file('logo_ekspedisi')->store('ekspedisi', 'public');
        }

        JenisPengiriman::create($data);

        return redirect()->route('jenis_pengiriman.index')->with('success', 'Jenis pengiriman berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jenisPengiriman = JenisPengiriman::findOrFail($id);
        return view('jenis_pengiriman.edit', [
            'title' => 'Admin',
            'menu' => 'Pengiriman',
            'jenisPengiriman' => $jenisPengiriman
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_kirim' => 'required|in:ekonomi,kargo,regular,same day,standar',
            'nama_ekspedisi' => 'required|string|max:255',
            // 'ongkos_kirim' => 'required|double',
            'ongkos_kirim' => 'required|integer',
            'logo_ekspedisi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $jenisPengiriman = JenisPengiriman::findOrFail($id);
        $data = $request->except('logo_ekspedisi');

        // Update logo jika ada upload baru
        if ($request->hasFile('logo_ekspedisi')) {
            // Hapus logo lama
            if ($jenisPengiriman->logo_ekspedisi) {
                Storage::disk('public')->delete($jenisPengiriman->logo_ekspedisi);
            }

            $data['logo_ekspedisi'] = $request->file('logo_ekspedisi')->store('ekspedisi', 'public');
        }

        $jenisPengiriman->update($data);

        return redirect()->route('jenis_pengiriman.index')->with('success', 'Jenis pengiriman berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jenisPengiriman = JenisPengiriman::findOrFail($id);

        // Hapus logo jika ada
        if ($jenisPengiriman->logo_ekspedisi) {
            Storage::disk('public')->delete($jenisPengiriman->logo_ekspedisi);
        }

        $jenisPengiriman->delete();

        return redirect()->route('jenis_pengiriman.index')->with('success', 'Jenis pengiriman berhasil dihapus!');
    }
}