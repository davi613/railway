<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\DetailPembelian;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\user;

class AuthController extends Controller
{
    public function adminIndex()
    {
        // return view('admin.index');
        $totalUsers = User::count();
        return view('admin.index',[
            'title' => 'Admin',
            'totalUsers' => $totalUsers
        ]);
    }

    public function apotekerIndex()
    {
        // return view('apoteker.index');
        return view('apoteker.index',[
            'title' => 'Apoteker'
        ]);
    }

    public function karyawanIndex()
    {
        // return view('karyawan.index');
        return view('karyawan.index',[
            'title' => 'Karyawan'
        ]);
    }

    public function kasirIndex()
    {
        // return view('pemilik.index');
        return view('kasir.index',[
            'title' => 'Kasir'
        ]);
    }

    public function pemilikIndex()
    {
        $totalPelanggan = Pelanggan::count();
        $totalPenjualan = Penjualan::where('status_order', 'selesai')->sum('total_bayar');
        $totalPembelian = DetailPembelian::sum('subtotal');
        // return view('pemilik.index');
        return view('pemilik.index',[
            'title' => 'Pemilik',
            'totalPelanggan' => $totalPelanggan,
            'totalPenjualan' => $totalPenjualan,
            'totalPembelian' => $totalPembelian
        ]);
    }

//     public function showDashboard()
// {
//     $user = auth()->user();

//     // Periksa peran pengguna (misalnya 'pemilik', 'admin', dll)
//     if ($user->role === 'pemilik') {
//         $title = 'Pemilik Dashboard';  // Sesuaikan judul untuk Pemilik
//     } elseif ($user->role === 'admin') {
//         $title = 'Admin Dashboard';  // Sesuaikan judul untuk Admin
//     } else {
//         $title = 'User Dashboard';  // Judul default
//     }

//     // Kirimkan title ke view
//     return view('dashboard', compact('title'));
// }

}

