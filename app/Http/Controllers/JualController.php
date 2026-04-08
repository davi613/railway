<?php

namespace App\Http\Controllers;

use App\Models\Jual;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JualController extends Controller
{
    public function create()
    {
        $obat = Obat::all();

        return view('jual.create', [
            'title' => 'Kasir',
            'menu'  => 'Tambah Jual',
            'obat'  => $obat
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_obat'     => 'required|array',
            'id_obat.*'   => 'required|exists:obat,id',
            'jumlah'      => 'required|array',
            'jumlah.*'    => 'required|integer|min:1',
            'harga'       => 'required|array',
            'harga.*'     => 'required|numeric|min:0',
        ]);

        // Validasi kumulatif stok per obat
        // Hitung total jumlah per id_obat dari request
        $totalPerObat = [];
        foreach ($validated['id_obat'] as $i => $obatId) {
            $qty = $validated['jumlah'][$i];
            if (!isset($totalPerObat[$obatId])) {
                $totalPerObat[$obatId] = 0;
            }
            $totalPerObat[$obatId] += $qty;
        }

        // Cek apakah total jumlah melebihi stok yang tersedia
        foreach ($totalPerObat as $obatId => $totalQty) {
            $obat = Obat::find($obatId);
            if ($obat && $totalQty > $obat->stok) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors([
                        'jumlah' => 'Total jumlah untuk obat "' . $obat->nama_obat . '" (' . $totalQty . ') melebihi stok yang tersedia (' . $obat->stok . ').'
                    ]);
            }
        }

        DB::transaction(function() use ($validated) {
            foreach ($validated['id_obat'] as $i => $obatId) {
                $qty   = $validated['jumlah'][$i];
                $price = $validated['harga'][$i];
                $sub   = $qty * $price;

                Jual::create([
                    'id_obat'  => $obatId,
                    'jumlah'   => $qty,
                    'harga'    => $price,
                    'subtotal' => $sub,
                ]);

                Obat::where('id', $obatId)->decrement('stok', $qty);
            }
        });
        return redirect()
       ->route('jual.create')
       ->with('success', 'Semua data penjualan berhasil disimpan!');
    }
}