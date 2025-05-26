<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil data produk (obat) dari database
        $obats = Obat::with('jenisObat')->get();

        $search = $request->input('search');

        $query = Obat::query();
    
        if ($search) {
            $query->where('nama_obat', 'like', '%' . $search . '%');
        }
    
        $obats = $query->paginate(10); // Sesuaikan dengan kebutuhan
        return view('shop.index', [
            'title' => 'Shop',
            'obats' => $obats  // kirimkan data obat ke view
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
