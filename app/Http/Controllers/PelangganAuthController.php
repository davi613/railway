<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PelangganAuthController extends Controller
{
    // Tampilkan Form Login
    public function showLoginForm()
    {
        return view('pelanggan.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('pelanggan')->attempt($request->only('email', 'password'))) {
            return redirect()->route('home.index')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // Tampilkan Form Register
    public function showRegisterForm()
    {
        return view('pelanggan.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggan|max:255',
            'password' => 'required|string|min:8|confirmed',
            'no_telp' => 'required|string|max:15',
            'alamat1' => 'required|string|max:255',
            'kota1' => 'required|string|max:255',
            'provinsi1' => 'required|string|max:255',
            'kodepos1' => 'required|string|max:10',
            'alamat2' => 'nullable|string|max:255',
            'kota2' => 'nullable|string|max:255',
            'provinsi2' => 'nullable|string|max:255',
            'kodepos2' => 'nullable|string|max:10',
            'alamat3' => 'nullable|string|max:255',
            'kota3' => 'nullable|string|max:255',
            'provinsi3' => 'nullable|string|max:255',
            'kodepos3' => 'nullable|string|max:10',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'url_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file upload
        $fotoPath = null;
        $ktpPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pelanggan/foto', 'public');
        }

        if ($request->hasFile('url_ktp')) {
            $ktpPath = $request->file('url_ktp')->store('pelanggan/ktp', 'public');
        }

        // Create pelanggan
        Pelanggan::create([
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'no_telp' => $validated['no_telp'],
            'alamat1' => $validated['alamat1'],
            'kota1' => $validated['kota1'],
            'provinsi1' => $validated['provinsi1'],
            'kodepos1' => $validated['kodepos1'],
            'alamat2' => $validated['alamat2'] ?? null,
            'kota2' => $validated['kota2'] ?? null,
            'provinsi2' => $validated['provinsi2'] ?? null,
            'kodepos2' => $validated['kodepos2'] ?? null,
            'alamat3' => $validated['alamat3'] ?? null,
            'kota3' => $validated['kota3'] ?? null,
            'provinsi3' => $validated['provinsi3'] ?? null,
            'kodepos3' => $validated['kodepos3'] ?? null,
            'foto' => $fotoPath,
            'url_ktp' => $ktpPath,
        ]);

        return redirect()->route('pelanggan.login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }
    // Logout
    public function logout()
    {
        Auth::guard('pelanggan')->logout();
        return redirect()->route('pelanggan.login');
    }
}