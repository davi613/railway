<?php

namespace App\Http\Controllers;

use App\Models\JenisPengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JenisPengirimanController extends Controller
{
    public function index(Request $request)
    {
        $query = JenisPengiriman::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('jenis_kirim', 'like', "%$search%")
                  ->orWhere('nama_ekspedisi', 'like', "%$search%");
        }

        $jenisPengiriman = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('jenis_pengiriman.index', [
            'jenisPengiriman' => $jenisPengiriman,
            'title'           => 'Admin',
            'menu'            => 'Pengiriman',
        ]);
    }

    public function create()
    {
        return view('jenis_pengiriman.create', [
            'title' => 'Admin',
            'menu'  => 'Pengiriman'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kirim'    => 'required|in:ekonomi,kargo,regular,same day,standar',
            'nama_ekspedisi' => 'required|string|max:255',
            'ongkos_kirim'   => 'required|integer',
            'logo_ekspedisi' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('logo_ekspedisi');

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
            'title'           => 'Admin',
            'menu'            => 'Pengiriman',
            'jenisPengiriman' => $jenisPengiriman
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_kirim'    => 'required|in:ekonomi,kargo,regular,same day,standar',
            'nama_ekspedisi' => 'required|string|max:255',
            'ongkos_kirim'   => 'required|integer',
            'logo_ekspedisi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $jenisPengiriman = JenisPengiriman::findOrFail($id);
        $data = $request->except('logo_ekspedisi');

        if ($request->hasFile('logo_ekspedisi')) {
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

        // Cek apakah jenis pengiriman ini sudah memiliki relasi ke data penjualan
        if ($jenisPengiriman->penjualan()->count() > 0) {
            return redirect()->route('jenis_pengiriman.index')
                ->with('error', 'Jenis pengiriman tidak dapat dihapus karena sudah digunakan dalam data penjualan!');
        }

        if ($jenisPengiriman->logo_ekspedisi) {
            Storage::disk('public')->delete($jenisPengiriman->logo_ekspedisi);
        }

        $jenisPengiriman->delete();

        return redirect()->route('jenis_pengiriman.index')->with('success', 'Jenis pengiriman berhasil dihapus!');
    }
}