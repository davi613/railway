<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $totalExpense = DB::table('penjualan') // gunakan 'penjualan' sesuai nama tabel di migration
                        ->where('status_order', 'Selesai') // filter status order 'Selesai'
                        ->sum('total_bayar');
    
    $totalbeli = DB::table('detail_pembelian')->sum('subtotal');

    $totalkasir = DB::table('jual')->sum('subtotal');
    
    $return = ($totalExpense + $totalkasir) - $totalbeli;
    
    // Tentukan warna berdasarkan nilai return
    $returnColor = $return < 0 ? 'text-danger' : 'text-success';
    
    return view('report.index', [
        'title' => 'Pemilik',
        'totalExpense' => $totalExpense,
        'totalbeli' => $totalbeli,
        'totalkasir' => $totalkasir,
        'return' => $return,
        'returnColor' => $returnColor
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
