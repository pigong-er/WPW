<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman pengaturan profil
     */
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        return view('admin.pengaturan', compact('user'));
    }

    /**
     * Menyimpan perubahan profil
     */
    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        // Validasi
        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255'
            ],

            'username' => [
                'required',
                'string',
                'max:255',
                'unique:users,username,' . $user->id
            ],

            'password' => [
                'nullable',
                'string',
                'min:6',
                'confirmed'
            ],

            'foto_profil' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048'
            ],
        ], [
            'nama.required' => 'Nama wajib diisi.',

            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',

            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',

            'foto_profil.image' => 'File harus berupa gambar.',
            'foto_profil.mimes' => 'Foto harus JPG, JPEG, atau PNG.',
            'foto_profil.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        // Update nama
        $user->name = $request->nama;

        // Update username
        $user->username = $request->username;

        // Update password hanya kalau diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Upload foto profil
        if ($request->hasFile('foto_profil')) {

            // Hapus foto lama
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            // Simpan foto baru
            $path = $request->file('foto_profil')
                ->store('foto_profil', 'public');

            $user->foto_profil = $path;
        }

        // Simpan ke database
        $user->save();

        return redirect()
            ->route('admin.pengaturan')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}
