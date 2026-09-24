<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Memproses login
     */
    public function authenticate(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Cek apakah checkbox "Ingat Saya" dicentang
        $remember = $request->has('remember');

        // Cek username dan password ke tabel users
        if (Auth::attempt($credentials, $remember)) {

            // Membuat session baru setelah login berhasil
            $request->session()->regenerate();

            // Masuk ke dashboard admin
            return redirect('/admin');
        }

        // Login gagal
        return back()
            ->withErrors([
                'username' => 'Username atau kata sandi yang Anda masukkan salah.',
            ])
            ->withInput($request->only('username'));
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Hapus session
        $request->session()->invalidate();

        // Buat token CSRF baru
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
