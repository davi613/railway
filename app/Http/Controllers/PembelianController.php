<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Distributor;
use Illuminate\Support\Facades\Storage;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembelians = Pembelian::with('distributor')->latest()->get();
        
        return view('pembelian.index', [
            'title' => 'Apoteker',
            'menu' => 'Pembelian',
            'pembelians' => $pembelians
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $distributors = Distributor::all();
        
        return view('pembelian.create', [
            'title' => 'Apoteker',
            'menu' => 'Pembelian',
            'distributors' => $distributors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nonota' => 'required|string|max:100|unique:pembelian',
            'tgl_pembelian' => 'required|date',
            'total_bayar' => 'required|numeric|min:0',
            'id_distributor' => 'required|exists:distributor,id'
        ]);

        try {
            Pembelian::create($request->all());
            
            return redirect()->route('pembelian.index')
                ->with('success', 'Data pembelian berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan data pembelian: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pembelian = Pembelian::with('distributor')->findOrFail($id);
        
        return view('pembelian.show', [
            'title' => 'Detail Pembelian',
            'menu' => 'Pembelian',
            'pembelian' => $pembelian
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $distributors = Distributor::all();
        
        return view('pembelian.edit', [
            'title' => 'Apoteker',
            'menu' => 'Pembelian',
            'pembelian' => $pembelian,
            'distributors' => $distributors
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nonota' => 'required|string|max:100|unique:pembelian,nonota,'.$id,
            'tgl_pembelian' => 'required|date',
            'total_bayar' => 'required|numeric|min:0',
            'id_distributor' => 'required|exists:distributor,id'
        ]);

        try {
            $pembelian = Pembelian::findOrFail($id);
            $pembelian->update($request->all());
            
            return redirect()->route('pembelian.index')
                ->with('success', 'Data pembelian berhasil diperbarui!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data pembelian: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pembelian = Pembelian::findOrFail($id);
            $pembelian->delete();
            
            return redirect()->route('pembelian.index')
                ->with('success', 'Data pembelian berhasil dihapus!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data pembelian: ' . $e->getMessage());
        }
    }
}