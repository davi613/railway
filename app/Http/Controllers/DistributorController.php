<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $distributors = Distributor::when($search, function ($query, $search) {
        return $query->where('nama_distributor', 'like', "%{$search}%")
                     ->orWhere('telepon', 'like', "%{$search}%")
                     ->orWhere('alamat', 'like', "%{$search}%");
    })->orderBy('created_at', 'desc')->paginate(10);

    return view('distributor.index', [
        'title' => 'Admin',
        'menu' => 'Distributor',
        'distributors' => $distributors,
        'search' => $search
    ]);
}


    public function create()
    {
        return view('distributor.create', [
            'title' => 'Admin',
            'menu' => 'Distributor'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_distributor' => 'required|string|max:50',
            'telepon' => 'required|numeric|digits_between:1,15', // Hanya angka, 8-15 digit
            'alamat' => 'required|string|max:255',
        ]);
    
        Distributor::create($request->all());
    
        return redirect()->route('distributor.index')->with('success', 'Distributor berhasil ditambahkan!');
    }
    

    public function edit($id)
    {
        $distributor = Distributor::findOrFail($id);
        return view('distributor.edit', [
            'title' => 'Admin',
            'menu' => 'Distributor',
            'distributor' => $distributor
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_distributor' => 'required|string|max:50',
            'telepon' => 'required|numeric|digits_between:8,15', // Hanya angka, 8-15 digit
            'alamat' => 'required|string|max:255',
        ]);
    
        $distributor = Distributor::findOrFail($id);
        $distributor->update($request->all());
    
        return redirect()->route('distributor.index')->with('success', 'Distributor berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $distributor = Distributor::findOrFail($id);
        $distributor->delete();

        return redirect()->route('distributor.index')->with('success', 'Distributor berhasil dihapus!');
    }
}