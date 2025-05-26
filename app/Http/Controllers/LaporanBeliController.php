<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPembelian;
use App\Models\Obat;

class LaporanBeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Ambil data dengan relasi ke obat
    $details = DetailPembelian::with('obat')
        ->select('id', 'id_obat', 'jumlah_beli', 'subtotal', 'created_at')
        ->latest()
        ->paginate(10);

    // Hitung total transaksi dan total nominal
    $totalTransaksi = DetailPembelian::count();
    $totalNominal = DetailPembelian::sum('subtotal');

    return view('laporan-beli.index', compact('details', 'totalTransaksi', 'totalNominal'), [
        'title' => 'Pemilik'
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
