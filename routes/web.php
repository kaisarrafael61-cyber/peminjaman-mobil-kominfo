<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Import Semua Controller
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PeminjamanController;

/*
|--------------------------------------------------------------------------
| ROUTE PUBLIC (Akses Bebas Tanpa Login)
|--------------------------------------------------------------------------
*/

// Halaman Utama / Landing Page
Route::get('/', function () {
    return view('welcome'); 
});

// Form Login
Route::get('/login-page', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('login');
})->name('login');

// Proses Login (Menggunakan PeminjamanController)
Route::post('/login-process', [PeminjamanController::class, 'login'])->name('login.process');

// Register & Forgot Password
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.forgot');


/*
|--------------------------------------------------------------------------
| ROUTE PROTECTED (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', function () {
        return view('dashboard'); 
    })->name('dashboard');

    // Ketersediaan Mobil
    Route::get('/ketersediaan-mobil', [CarController::class, 'index'])->name('ketersediaan.index');

    // ==========================================
    // FITUR PEMINJAMAN MOBIL (USER)
    // ==========================================
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    
    // Route Pengembalian & Upload Foto Sesudah (Menggunakan match GET & POST untuk cegah error 405)
    Route::match(['get', 'post'], '/peminjaman/{id}/foto-sesudah', [PeminjamanController::class, 'uploadFotoSesudah'])->name('peminjaman.upload-sesudah');
    Route::match(['get', 'post'], '/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'uploadFotoSesudah'])->name('peminjaman.kembalikan');

    // FITUR PEMINJAMAN MOBIL (ADMIN)
    Route::get('/admin/peminjaman', [PeminjamanController::class, 'adminIndex'])->name('admin.peminjaman.index');
    Route::post('/peminjaman/{id}/update-status', [PeminjamanController::class, 'updateStatus'])->name('peminjaman.update-status');

    // Lokasi & Antar Jemput
    Route::get('/lokasi-antar-jemput', [LokasiController::class, 'index'])->name('lokasi.index');

    // Fitur Chat / Coordination Center
    Route::get('/pesan/{receiverId?}', [MessageController::class, 'index'])->name('pesan.index');
    Route::post('/pesan/send', [MessageController::class, 'store'])->name('pesan.send');
    
    // Riwayat Peminjaman
    Route::get('/riwayat-pesan', [PeminjamanController::class, 'riwayat'])->name('riwayat.index');
    
    // === PENGATURAN AKUN ===
    Route::get('/pengaturan', function () {
        return view('pengaturan.index');
    })->name('pengaturan.index');
    
    Route::post('/pengaturan/profile', [PeminjamanController::class, 'updateProfile'])->name('pengaturan.profile.update');
    Route::post('/pengaturan/password', [PeminjamanController::class, 'updatePassword'])->name('pengaturan.password.update');

    // Logout
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');

});