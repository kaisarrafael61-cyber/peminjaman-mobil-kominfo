<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Memproses Registrasi Akun Baru
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Menyimpan user baru ke tabel 'users' di database
        User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login-page')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    // Memproses Pengajuan Lupa Password
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Untuk uji coba lokal, kita kembalikan alert simulasi sukses
        return redirect()->back()->with('success', 'Link setel ulang password telah dikirim ke email Anda!');
    }
}