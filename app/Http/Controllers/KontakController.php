<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    // Menampilkan form di halaman contact.index
    public function create()
    {
        return view('contact.index');
    }

    // Menyimpan data dari form contact
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        Kontak::create($request->all());

        return redirect()->route('contact.index')
            ->with('success', 'Pesan Anda telah terkirim! Kami akan segera menghubungi Anda.');
    }

    // Menampilkan daftar kontak (admin)
    public function index()
    {
        $kontaks = Kontak::latest()->get();
        return view('kontak.index', [
            'title' => 'Karyawan',
            'menu' => 'Kontak',
            'kontaks' => $kontaks
        ]);
    }

    // Menampilkan form edit (admin)
    public function edit($id)
    {
        $kontak = Kontak::findOrFail($id);
        return view('kontak.edit', [
            'title' => 'Karyawan',
            'menu' => 'Kontak',
            'kontak' => $kontak
        ]);
    }

    // Update data kontak (admin)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        $kontak = Kontak::findOrFail($id);
        $kontak->update($request->all());

        return redirect()->route('kontak.index')
            ->with('success', 'Data kontak berhasil diperbarui!');
    }

    // Hapus data kontak (admin)
    public function destroy($id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->delete();

        return redirect()->route('kontak.index')
            ->with('success', 'Pesan berhasil dihapus!');
    }
}