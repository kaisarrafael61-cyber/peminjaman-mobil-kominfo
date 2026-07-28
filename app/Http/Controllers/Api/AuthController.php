<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// bypass langsung memanggil class induk dari root namespace paling luar
class AuthController extends \App\Http\Controllers\Controller
{
    // ==========================================
    // 1. MENAMPILKAN HALAMAN (VIEW RENDERING)
    // ==========================================

    public function showLogin()
    {
        return view('login'); 
    }

    public function showRegister()
    {
        return view('register'); 
    }

    public function showForgotPassword()
    {
        return view('forgot-password'); 
    }

    // ==========================================
    // 2. PROSES LOGIKA (AUTHENTICATION LOGIC)
    // ==========================================

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Selamat datang kembali!');
        }

        return redirect()->back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->username, 
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login-page')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        return redirect()->back()->with('success', 'Link setel ulang password telah dikirim ke email Anda!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login-page')->with('success', 'Anda telah berhasil logout.');
    }
}