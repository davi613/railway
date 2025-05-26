<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\LoginController;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::resource('/admin', \App\Http\Controllers\AdminController::class);
// Route::resource('/pemilik', \App\Http\Controllers\PemilikController::class);
// Route::resource('/karyawan', \App\Http\Controllers\KaryawanController::class);
// Route::resource('/apoteker', \App\Http\Controllers\ApotekerController::class);

Route::resource('/', \App\Http\Controllers\HomeController::class);
Route::resource('/home', \App\Http\Controllers\HomeController::class);
Route::resource('/about', \App\Http\Controllers\AboutController::class);
Route::resource('/cart', \App\Http\Controllers\CartController::class);
Route::resource('/checkout', \App\Http\Controllers\CheckoutController::class);
Route::resource('/contact', \App\Http\Controllers\ContactController::class);
Route::resource('/shop', \App\Http\Controllers\ShopController::class);
Route::resource('/product-detail', \App\Http\Controllers\ProductdetailController::class);


//HALAMAN BACK END
Route::resource('/report', \App\Http\Controllers\ReportController::class);
Route::resource('/users', \App\Http\Controllers\UserController::class);
Route::resource('/obat', \App\Http\Controllers\ObatController::class);
Route::resource('/distributor', \App\Http\Controllers\DistributorController::class);
Route::resource('/metode_bayar', \App\Http\Controllers\MetodeBayarController::class);
Route::resource('/jenis_pengiriman', \App\Http\Controllers\JenisPengirimanController::class);
Route::resource('/pembelian', \App\Http\Controllers\PembelianController::class);
Route::resource('/detail_pembelian', \App\Http\Controllers\DetailPembelianController::class);
Route::resource('/jual', \App\Http\Controllers\JualController::class);
Route::resource('/jenis_obat', \App\Http\Controllers\JenisObatController::class);


// Route::resource('/login', \App\Http\Controllers\Auth\LoginController::class);
//
//HALAMAN LOGIN PELANGGAN//



Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin', [AuthController::class, 'adminIndex'])->name('admin.index');
});

Route::middleware(['role:apoteker'])->group(function () {
    Route::get('/apoteker', [AuthController::class, 'apotekerIndex'])->name('apoteker.index');
});

Route::middleware(['role:karyawan'])->group(function () {
    Route::get('/karyawan', [AuthController::class, 'karyawanIndex'])->name('karyawan.index');
});

Route::middleware(['role:pemilik'])->group(function () {
    Route::get('/pemilik', [AuthController::class, 'pemilikIndex'])->name('pemilik.index');
});

Route::middleware(['role:kasir'])->group(function () {
    Route::get('/kasir', [AuthController::class, 'kasirIndex'])->name('kasir.index');
});

// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); // Menampilkan form login

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // Logout

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//LOGIN FRONT END

