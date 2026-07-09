<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AuthController;

// =========================================================================
// ROUTE AUTENTIKASI (LOGIN, REGISTER, FORGOT PASSWORD)
// =========================================================================

Route::get('/', function () {
    return view('login');
});

// Jalur GET untuk menampilkan halaman login (mengakses web)
Route::get('/login-page', function () {
    return view('login');
})->name('login');

// Jalur POST untuk menerima data ketika tombol Login ditekan
Route::post('/login-process', function (\Illuminate\Http\Request $request) {
    // PERBAIKAN: Validasi disesuaikan dengan input dari form HTML (Username & Password)
    $request->validate([
        'username' => ['required'],
        'password' => ['required'],
    ]);

    // Simulasi bypass login sukses langsung dialihkan ke dashboard
    return redirect('/dashboard');
});

// Jalur Tampilan Halaman Register & Lupa Password (GET)
Route::get('/register-page', function () {
    return view('register');
});

Route::get('/forgot-password-page', function () {
    return view('forgot-password');
});

// Jalur Eksekusi Data Form ke Controller (POST)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);


// =========================================================================
// ROUTE APLIKASI (DASHBOARD & PEMINJAMAN)
// =========================================================================

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/pinjam', function () {
    return view('pinjam');
});

// Jalur untuk melihat halaman "Pesanan Anda"
Route::get('/pesanan', [PeminjamanController::class, 'index'])->name('pesanan.index');

// Jalur API/Action untuk memproses kiriman data dari form ke database
Route::post('/pinjam/store', [PeminjamanController::class, 'store'])->name('pinjam.store');


// =========================================================================
// ROUTE KHUSUS KABAG (PERSETUJUAN)
// =========================================================================

// Halaman daftar persetujuan untuk Kabag
Route::get('/kabag/persetujuan', [PeminjamanController::class, 'kabagIndex'])->name('kabag.index');

// Route untuk aksi Setuju / Tolak
Route::post('/kabag/persetujuan/{id}/{status}', [PeminjamanController::class, 'kabagUpdateStatus'])->name('kabag.status');