<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Setelah login berhasil, arahkan pengguna berdasarkan jabatan mereka.
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticated()
    {
        $userRole = Auth::user()->jabatan;

        if ($userRole === 'admin') {
            return redirect()->route('admin.index');

        } elseif ($userRole === 'apoteker') {
            return redirect()->route('apoteker.index');

        } elseif ($userRole === 'karyawan') {
            return redirect()->route('karyawan.index');

        } elseif ($userRole === 'kasir') {
            return redirect()->route('kasir.index');
            
        } elseif ($userRole === 'pemilik') {
            return redirect()->route('pemilik.index');
        }

        return redirect('/');
    }

    public function logout()
{
    Auth::logout();  // Mengeluarkan pengguna dari sesi
    return redirect('/login');  // Arahkan ke halaman login setelah logout
}

// public function login(Request $request)
// {
//     $credentials = $request->only('email', 'password');

//     if (Auth::attempt($credentials)) {
//         // Jika login berhasil, arahkan ke halaman yang sesuai
//         return redirect()->intended('/login');
//     }

//     // Jika login gagal, kembali ke halaman login dengan pesan error
//     return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
// }



}
