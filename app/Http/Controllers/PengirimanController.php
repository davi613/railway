<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PengirimanController extends Controller
{
    public function index()
    {
        $pengirimans = Pengiriman::with('penjualan')->get();
        return view('pengiriman.index', compact('pengirimans'),[
            'title' => 'Karyawan'
        ]);
    }

    public function create()
    {
        // Hanya id_penjualan dengan status 'Menunggu Kurir' yang bisa dipilih
        $penjualans = Penjualan::where('status_order', 'Menunggu Kurir')
                            ->whereNotIn('id', Pengiriman::pluck('id_penjualan'))
                            ->get();
        return view('pengiriman.create', compact('penjualans'),[
            'title' => 'Karyawan'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penjualan' => 'required|exists:penjualan,id,status_order,Menunggu Kurir',
            'tgl_kirim' => 'required|date',
            'tgl_tiba' => 'nullable|date', // Tanggal Tiba, bisa kosong
            'nama_kurir' => 'required|string|max:30',
            'telpon_kurir' => 'required|string|max:15',
            'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|string|in:Sedang Dikirim,Tiba Di Tujuan', // Status pengiriman
            'keterangan' => 'nullable|string',
        ]);

        // Generate nomor invoice yang unik
        do {
            $no_invoice = mt_rand(1000000, 9999999);
        } while (Pengiriman::where('no_invoice', $no_invoice)->exists());

        $bukti_foto = null;
        if ($request->hasFile('bukti_foto')) {
            $bukti_foto = $request->file('bukti_foto')->store('bukti_foto', 'public');
        }

        Pengiriman::create([
            'id_penjualan' => $request->id_penjualan,
            'no_invoice' => $no_invoice,
            'tgl_kirim' => $request->tgl_kirim,
            'tgl_tiba' => $request->tgl_tiba,
            'nama_kurir' => $request->nama_kurir,
            'telpon_kurir' => $request->telpon_kurir,
            'bukti_foto' => $bukti_foto,
            'status_kirim' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pengiriman.index')->with('success', 'Data pengiriman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        // $penjualans = Penjualan::where('status_order', 'Menunggu Kurir')->get();
        return view('pengiriman.edit', compact('pengiriman'),[
            'title' => 'Karyawan'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'id_penjualan' => 'required|exists:penjualan,id,status_order,Menunggu Kurir',
            'tgl_kirim' => 'required|date',
            'tgl_tiba' => 'nullable|date', // Tanggal Tiba, bisa kosong
            'nama_kurir' => 'required|string|max:30',
            'telpon_kurir' => 'required|string|max:15',
            'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|string|in:Sedang Dikirim,Tiba Di Tujuan', // Status pengiriman
            'keterangan' => 'nullable|string',
        ]);

        $pengiriman = Pengiriman::findOrFail($id);
        
        // Update foto jika ada
        if ($request->hasFile('bukti_foto')) {
            if ($pengiriman->bukti_foto) {
                Storage::delete('public/' . $pengiriman->bukti_foto);
            }
            $pengiriman->bukti_foto = $request->file('bukti_foto')->store('bukti_foto', 'public');
        }

        $pengiriman->update([
            // 'id_penjualan' => $request->id_penjualan,
            'tgl_kirim' => $request->tgl_kirim,
            'tgl_tiba' => $request->tgl_tiba,
            'nama_kurir' => $request->nama_kurir,
            'telpon_kurir' => $request->telpon_kurir,
            'status_kirim' => $request->status,
            'bukti_foto' => $pengiriman->bukti_foto,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pengiriman.index')->with('success', 'Data pengiriman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        if ($pengiriman->bukti_foto) {
            Storage::delete('public/' . $pengiriman->bukti_foto);
        }
        $pengiriman->delete();
        return redirect()->route('pengiriman.index')->with('success', 'Data pengiriman berhasil dihapus.');
    }
}
