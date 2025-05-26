<?php

namespace App\Http\Controllers;

use App\Models\MetodeBayar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MetodeBayarController extends Controller
{
    public function index()
    {
        $metodeBayars = MetodeBayar::all();
        return view('metode_bayar.index', [
            'title' => 'Admin',
            'menu' => 'Metode Bayar',
            'metodeBayars' => $metodeBayars
        ]);
    }

    public function create()
    {
        return view('metode_bayar.create', [
            'title' => 'Admin',
            'menu' => 'Metode Bayar'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required|string|max:30',
            'tempat_bayar' => 'required|string|max:50',
            'no_rekening' => 'nullable|string|max:25',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            $data['url_logo'] = $request->file('logo')->store('metode_bayar_logo', 'public');
        }

        MetodeBayar::create($data);

        return redirect()->route('metode_bayar.index')->with('success', 'Metode pembayaran berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $metodeBayar = MetodeBayar::findOrFail($id);
        return view('metode_bayar.edit', [
            'title' => 'Admin',
            'menu' => 'Metode Bayar',
            'metodeBayar' => $metodeBayar
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'metode_pembayaran' => 'required|string|max:30',
            'tempat_bayar' => 'required|string|max:50',
            'no_rekening' => 'nullable|string|max:25',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $metodeBayar = MetodeBayar::findOrFail($id);
        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            if ($metodeBayar->url_logo) {
                Storage::disk('public')->delete($metodeBayar->url_logo);
            }

            $data['url_logo'] = $request->file('logo')->store('metode_bayar_logo', 'public');
        }

        $metodeBayar->update($data);

        return redirect()->route('metode_bayar.index')->with('success', 'Metode pembayaran berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $metodeBayar = MetodeBayar::findOrFail($id);

        if ($metodeBayar->url_logo) {
            Storage::disk('public')->delete($metodeBayar->url_logo);
        }

        $metodeBayar->delete();

        return redirect()->route('metode_bayar.index')->with('success', 'Metode pembayaran berhasil dihapus!');
    }
}