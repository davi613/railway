<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class CostumerController extends Controller
{
    
    public function index(Request $request)
{
    $search = $request->input('search');

    $pelanggans = Pelanggan::query()
        ->when($search, function ($query, $search) {
            $query->where('nama_pelanggan', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        })
        ->paginate(10)
        ->withQueryString(); // menjaga ?search tetap ada di URL saat ganti halaman

    return view('costumer.index', compact('pelanggans', 'search'), [
        'title' => 'Admin'
    ]);
}
    
}
