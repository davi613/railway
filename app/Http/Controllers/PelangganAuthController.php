<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Mail\VerifikasiEmail;
use App\Mail\ResetPasswordEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PelangganAuthController extends Controller
{
    // ===================== LOGIN =====================

    public function showLoginForm()
    {
        return view('pelanggan.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $pelanggan = Pelanggan::where('email', $request->email)->first();

        if (!$pelanggan) {
            return back()->withErrors(['email' => 'Email tidak terdaftar.'])->withInput();
        }

        if (is_null($pelanggan->email_verified_at)) {
            return back()->withErrors(['email' => 'Akun Anda belum diverifikasi. Silakan cek email Anda untuk link verifikasi.'])->withInput();
        }

        if (Auth::guard('pelanggan')->attempt($request->only('email', 'password'))) {
            return redirect()->route('home.index')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    // ===================== REGISTER =====================

    public function showRegisterForm()
    {
        return view('pelanggan.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email'          => 'required|email|unique:pelanggan|max:255',
            'password'       => 'required|string|min:8|confirmed',
            'no_telp'        => 'required|string|max:15',
            'alamat1'        => 'required|string|max:255',
            'kota1'          => 'required|string|max:255',
            'provinsi1'      => 'required|string|max:255',
            'kodepos1'       => 'required|string|max:10',
            'alamat2'        => 'nullable|string|max:255',
            'kota2'          => 'nullable|string|max:255',
            'provinsi2'      => 'nullable|string|max:255',
            'kodepos2'       => 'nullable|string|max:10',
            'alamat3'        => 'nullable|string|max:255',
            'kota3'          => 'nullable|string|max:255',
            'provinsi3'      => 'nullable|string|max:255',
            'kodepos3'       => 'nullable|string|max:10',
            'foto'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'url_ktp'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = null;
        $ktpPath  = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pelanggan/foto', 'public');
        }

        if ($request->hasFile('url_ktp')) {
            $ktpPath = $request->file('url_ktp')->store('pelanggan/ktp', 'public');
        }

        $token = Str::random(64);

        // Simpan data sementara di tabel pelanggan dengan email_verified_at = null
        $pelanggan = Pelanggan::create([
            'nama_pelanggan'           => $validated['nama_pelanggan'],
            'email'                    => $validated['email'],
            'password'                 => Hash::make($validated['password']),
            'no_telp'                  => $validated['no_telp'],
            'alamat1'                  => $validated['alamat1'],
            'kota1'                    => $validated['kota1'],
            'provinsi1'                => $validated['provinsi1'],
            'kodepos1'                 => $validated['kodepos1'],
            'alamat2'                  => $validated['alamat2'] ?? null,
            'kota2'                    => $validated['kota2'] ?? null,
            'provinsi2'                => $validated['provinsi2'] ?? null,
            'kodepos2'                 => $validated['kodepos2'] ?? null,
            'alamat3'                  => $validated['alamat3'] ?? null,
            'kota3'                    => $validated['kota3'] ?? null,
            'provinsi3'                => $validated['provinsi3'] ?? null,
            'kodepos3'                 => $validated['kodepos3'] ?? null,
            'foto'                     => $fotoPath,
            'url_ktp'                  => $ktpPath,
            'email_verification_token' => $token,
            'email_verified_at'        => null,
        ]);

        // Kirim email verifikasi
        Mail::to($pelanggan->email)->send(new VerifikasiEmail($pelanggan, $token));

        return redirect()->route('pelanggan.login')
            ->with('success', 'Registrasi berhasil! Silakan cek email Anda untuk memverifikasi akun.');
    }

    // Proses verifikasi email
    public function verifyEmail(Request $request, $token)
    {
        $pelanggan = Pelanggan::where('email_verification_token', $token)->first();

        if (!$pelanggan) {
            return redirect()->route('pelanggan.login')
                ->withErrors(['email' => 'Link verifikasi tidak valid atau sudah digunakan.']);
        }

        $pelanggan->update([
            'email_verified_at'        => Carbon::now(),
            'email_verification_token' => null,
        ]);

        return redirect()->route('pelanggan.login')
            ->with('success', 'Email berhasil diverifikasi! Silakan login.');
    }

    // ===================== FORGOT PASSWORD =====================

    public function showForgotForm()
    {
        return view('pelanggan.forgot');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $pelanggan = Pelanggan::where('email', $request->email)->first();

        if (!$pelanggan) {
            return back()->withErrors(['email' => 'Email tidak terdaftar dalam sistem kami.'])->withInput();
        }

        // Hapus token lama jika ada
        DB::table('password_resets')->where('email', $request->email)->delete();

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email'      => $request->email,
            'token'      => Hash::make($token),
            'created_at' => Carbon::now(),
        ]);

        Mail::to($request->email)->send(new ResetPasswordEmail($pelanggan, $token));

        return back()->with('success', 'Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.');
    }

    public function showGantiPwForm(Request $request, $token)
    {
        return view('pelanggan.gantipw', ['token' => $token, 'email' => $request->email]);
    }

    public function gantiPassword(Request $request)
    {
        $request->validate([
            'token'                 => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|string|min:8|confirmed',
        ]);

        $resetRecord = DB::table('password_resets')
            ->where('email', $request->email)
            ->first();

        if (!$resetRecord) {
            return back()->withErrors(['email' => 'Link reset password tidak valid atau sudah kedaluwarsa.']);
        }

        // Cek apakah token sudah kedaluwarsa (60 menit)
        if (Carbon::parse($resetRecord->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_resets')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'Link reset password sudah kedaluwarsa. Silakan minta link baru.']);
        }

        if (!Hash::check($request->token, $resetRecord->token)) {
            return back()->withErrors(['email' => 'Token tidak valid.']);
        }

        $pelanggan = Pelanggan::where('email', $request->email)->first();

        if (!$pelanggan) {
            return back()->withErrors(['email' => 'Akun tidak ditemukan.']);
        }

        $pelanggan->update([
            'password' => Hash::make($request->password),
        ]);

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('pelanggan.login')
            ->with('success', 'Password berhasil diperbarui! Silakan login dengan password baru Anda.');
    }

    // ===================== LOGOUT =====================

    public function logout()
    {
        Auth::guard('pelanggan')->logout();
        return redirect()->route('pelanggan.login');
    }
}