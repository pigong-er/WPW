<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Menampilkan halaman pengaturan
    public function index()
    {
        // Mengambil data user yang sedang login
        $user = Auth::user();
        return view('admin.pengaturan', compact('user'));
    }

    // Memproses update data ke database
    public function update(Request $request)
    {
        $user = Auth::user(); // Ambil data user yang sedang login

        // 1. Validasi Input
        $request->validate([
            'nama'                  => 'required|string|max:255',
            // Username harus unik, kecuali milik user itu sendiri
            'username'              => 'required|string|max:255|unique:users,username,' . $user->id,
            'password'              => 'nullable|min:6|confirmed', // 'confirmed' berarti harus sama dengan 'password_confirmation'
            'foto_profil'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Update Nama dan Username
        // (Pastikan kolom 'nama' di database Anda namanya 'name' atau sesuaikan dengan struktur DB Anda)
        $user->name = $request->nama;
        $user->username = $request->username;

        // 3. Update Password (Hanya jika diisi)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // 4. Update Foto Profil (Jika ada file yang diunggah)
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($user->foto_profil) {
                Storage::delete('public/' . $user->foto_profil);
            }
            // Simpan foto baru
            $path = $request->file('foto_profil')->store('public/foto_profil');
            $user->foto_profil = str_replace('public/', '', $path);
        }

        // 5. Simpan semua perubahan ke database
        $user->save();

        return redirect()->back()->with('success', 'Profil dan keamanan akun berhasil diperbarui!');
    }
}
