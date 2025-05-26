<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JualController;
use App\Http\Controllers\DetailJualController;
use App\Http\Controllers\PelangganProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\KonfirmasiController;
use App\Http\Controllers\DetailPesananController;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::resource('/admin', \App\Http\Controllers\AdminController::class);
// Route::resource('/pemilik', \App\Http\Controllers\PemilikController::class);
// Route::resource('/karyawan', \App\Http\Controllers\KaryawanController::class);
// Route::resource('/apoteker', \App\Http\Controllers\ApotekerController::class);

//PROFILE
// Profile Pelanggan
Route::prefix('profile')->middleware(['pelanggan.auth'])->group(function () {
    Route::get('/', [PelangganProfileController::class, 'index'])->name('profile.index');
    Route::get('/edit', [PelangganProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/update', [PelangganProfileController::class, 'update'])->name('profile.update');
});
//PROFILE

//Checkout
Route::group(['middleware' => ['auth:pelanggan']], function() {
    // Checkout routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});
//Checkout

//Keranjang//
Route::group(['middleware' => ['auth:pelanggan']], function() {
    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});
//Keranjang//

//pesanan
Route::middleware(['auth:pelanggan'])->group(function () {
    // Order routes
    Route::get('/pesanan', [OrderController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [OrderController::class, 'show'])->name('pesanan.show');
    Route::put('/pesanan/{id}/batalkan', [OrderController::class, 'cancel'])->name('pesanan.batalkan');
});

Route::get('/detail-pesanan/{id}', [DetailPesananController::class, 'show'])->name('detail_pesanan.show');
//pesanan

//FRONT-END
Route::resource('/', \App\Http\Controllers\HomeController::class);
Route::resource('/home', \App\Http\Controllers\HomeController::class);
Route::resource('/pesanan', \App\Http\Controllers\OrderController::class);
Route::resource('/about', \App\Http\Controllers\AboutController::class);
Route::resource('/cart', \App\Http\Controllers\CartController::class);
Route::resource('/checkout', \App\Http\Controllers\CheckoutController::class);
Route::resource('/contact', \App\Http\Controllers\ContactController::class);
Route::resource('/shop', \App\Http\Controllers\ShopController::class);
Route::resource('/kontak', \App\Http\Controllers\KontakController::class);
Route::resource('/product-detail', \App\Http\Controllers\ProductdetailController::class);
//FRONT-END


//HALAMAN BACK END
Route::resource('/detail_jual', \App\Http\Controllers\DetailJualController::class);

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin', [AuthController::class, 'adminIndex'])->name('admin.index');
    Route::resource('/users', \App\Http\Controllers\UserController::class);
    Route::resource('/costumer', \App\Http\Controllers\CostumerController::class);
    Route::resource('/distributor', \App\Http\Controllers\DistributorController::class);
    Route::resource('/metode_bayar', \App\Http\Controllers\MetodeBayarController::class);
    Route::resource('/jenis_pengiriman', \App\Http\Controllers\JenisPengirimanController::class);

});

Route::middleware(['role:apoteker'])->group(function () {
    Route::get('/apoteker', [AuthController::class, 'apotekerIndex'])->name('apoteker.index');
    Route::resource('/obat', \App\Http\Controllers\ObatController::class);
    Route::resource('/jenis_obat', \App\Http\Controllers\JenisObatController::class);
    Route::resource('/pembelian', \App\Http\Controllers\PembelianController::class);
    Route::resource('/detail_pembelian', \App\Http\Controllers\DetailPembelianController::class);
});

Route::middleware(['role:karyawan'])->group(function () {
    Route::get('/karyawan', [AuthController::class, 'karyawanIndex'])->name('karyawan.index');
    Route::resource('/penjualan', \App\Http\Controllers\PenjualanController::class);
    Route::resource('/pengiriman',\App\Http\Controllers\PengirimanController::class);
    Route::resource('/stok_obat',\App\Http\Controllers\StokObatController::class);

});

Route::middleware(['role:pemilik'])->group(function () {
    Route::get('/pemilik', [AuthController::class, 'pemilikIndex'])->name('pemilik.index');
    Route::resource('/laporan-jual', \App\Http\Controllers\LaporanJualController::class);
    Route::resource('/laporan-beli', \App\Http\Controllers\LaporanBeliController::class);
    Route::resource('/laporan_kasir', \App\Http\Controllers\LaporanKasirController::class);
    Route::resource('/report', \App\Http\Controllers\ReportController::class);

});

Route::middleware(['role:kasir'])->group(function () {
    Route::get('/kasir', [AuthController::class, 'kasirIndex'])->name('kasir.index');
    Route::resource('/jual', \App\Http\Controllers\JualController::class);
    Route::post('/jual/bulk-delete', [JualController::class, 'bulkDelete'])->name('jual.bulkDelete');
    // Route::post('/jual/bulkHideUnhide', [JualController::class, 'bulkHideUnhide'])->name('jual.bulkHideUnhide');
    Route::resource('/konfirmasi', \App\Http\Controllers\KonfirmasiController::class);
    Route::get('/konfirmasi/{id}', [KonfirmasiController::class, 'show'])->name('konfirmasi.show');
});

// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); // Menampilkan form login

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // Logout

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//LOGIN FRONT END

// Auth Pelanggan
Route::prefix('pelanggan')->group(function () {
    Route::get('/login', [PelangganAuthController::class, 'showLoginForm'])->name('pelanggan.login');
    Route::post('/login', [PelangganAuthController::class, 'login'])->name('pelanggan.login.submit');
    Route::get('/register', [PelangganAuthController::class, 'showRegisterForm'])->name('pelanggan.register');
    Route::post('/register', [PelangganAuthController::class, 'register'])->name('pelanggan.register.submit');
    Route::post('/logout', [PelangganAuthController::class, 'logout'])->name('pelanggan.logout');
});

// Route yang membutuhkan auth pelanggan
Route::middleware(['pelanggan.auth'])->group(function () {
    // Contoh: Route::get('/profile', ...)->name('pelanggan.profile');
});


//CETAK PDF
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\LaporanPembelianController;

Route::get('/laporan/penjualan/download', [LaporanPenjualanController::class, 'downloadPDF']);
Route::get('/laporan/pembelian/download', [LaporanPembelianController::class, 'downloadPDF']);

use App\Http\Controllers\LaporanAdminController;

Route::get('/laporan/admin/pdf', [LaporanAdminController::class, 'cetakPDF'])->name('laporan.admin.pdf');

use App\Http\Controllers\ExportJualController;
Route::get('/laporan/jual/pdf', [ExportJualController::class, 'exportPDF'])->name('laporan.jual.pdf');

//CETAK PDF

//MIDTRANS
// Midtrans routes
// Midtrans routes
Route::post('/checkout/notification', [CheckoutController::class, 'notification']);
Route::get('/checkout/finish/{id}', [CheckoutController::class, 'finish'])->name('checkout.finish');
//MIDTRANS