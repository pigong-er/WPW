<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Ditambahkan untuk Sanctum API
use App\Models\User; // Ditambahkan untuk Sanctum API

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login (WEB)
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Memproses login (WEB)
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
     * Logout (WEB)
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

    // =========================================================================
    // ENDPOINT UNTUK API SANCTUM (MOBILE / FRONTEND TERPISAH)
    // =========================================================================

        /**
     * Memproses login dan generate Token (API)
     */
    public function loginApi(Request $request)
    {
        // Validasi menggunakan 'email' sesuai standar API & modul
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        // Verifikasi kecocokan email dan password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Buat token untuk user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Kembalikan token dalam format JSON
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    /**
     * Menghapus Token saat ini (API)
     */
    public function logoutApi(Request $request)
    {
        // Menghapus token yang sedang digunakan untuk request ini[cite: 3]
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
