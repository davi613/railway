<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class CostumerController extends Controller
{
        public function index()
        {
            $pelanggans = Pelanggan::all();
            return view('costumer.index', compact('pelanggans'),[
                'title' => 'Admin'
            ]);
        }
    
        public function destroy($id)
        {
            $pelanggan = Pelanggan::findOrFail($id);
            $pelanggan->delete();
    
            return redirect()->route('costumer.index')->with('success', 'Data pelanggan berhasil dihapus.');
        }
    
}
