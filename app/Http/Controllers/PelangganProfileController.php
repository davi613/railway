<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PelangganProfileController extends Controller


{
    // Tampilkan profile pelanggan
    public function index()
    {
        $pelanggan = Auth::guard('pelanggan')->user();
        return view('profile.index', compact('pelanggan'), [
            'title' => 'Profile',]);
    }

    // Tampilkan form edit
    public function edit()
    {
        $pelanggan = Auth::guard('pelanggan')->user();
        return view('profile.edit', compact('pelanggan'),[
            'title' => 'Edit Profile',]);
    }

    // Proses update data
    public function update(Request $request)
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggan,email,'.$pelanggan->id,
            'no_telp' => 'required|string|max:15',
            'alamat1' => 'required|string|max:255',
            'kota1' => 'required|string|max:255',
            'provinsi1' => 'required|string|max:255',
            'kodepos1' => 'required|string|max:10',
            'alamat2' => 'nullable|string|max:255',
            'kota2' => 'nullable|string|max:255',
            'provinsi2' => 'nullable|string|max:255',
            'kodepos2' => 'nullable|string|max:10',
            'alamat3' => 'nullable|string|max:255',
            'kota3' => 'nullable|string|max:255',
            'provinsi3' => 'nullable|string|max:255',
            'kodepos3' => 'nullable|string|max:10',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'url_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pelanggan->foto) {
                Storage::delete('public/'.$pelanggan->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pelanggan/foto', 'public');
        }

        if ($request->hasFile('url_ktp')) {
            // Hapus KTP lama jika ada
            if ($pelanggan->url_ktp) {
                Storage::delete('public/'.$pelanggan->url_ktp);
            }
            $validated['url_ktp'] = $request->file('url_ktp')->store('pelanggan/ktp', 'public');
        }

        $pelanggan->update($validated);

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');

        $request->validate([
            'email' => 'required|email|unique:pelanggans,email,' . $pelanggan->id,
        ], [
            'email.unique' => 'Email sudah terdaftar.',
        ]);
        
    }
}