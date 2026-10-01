<?php

use Illuminate\Support\Facades\Route;
use App\Models\AlatOutdoor;
use App\Http\Controllers\Admin\KatalogController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\KasirController;
use App\Http\Controllers\AuthController;


// ============================================
// ROUTE FRONTEND (Halaman Publik)
// ============================================
Route::get('/', function () {
    $alat = AlatOutdoor::where('is_active', 1)->get(); // hanya tampil yang aktif
    return view('welcome', compact('alat'));
})->name('home');


// ============================================
// ROUTE LOGIN
// ============================================
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');


// ============================================
// ROUTE ADMIN PANEL (Wajib Login)
// ============================================
Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {

        // ---------- Dashboard ----------
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // ---------- CRUD Katalog Alat ----------
        Route::resource('katalog', KatalogController::class);

        // ---------- KASIR SEWA ----------
        Route::prefix('kasir')->name('kasir')->group(function () {
            Route::get('/', [KasirController::class, 'index'])->name('');            // admin.kasir
            Route::post('/store', [KasirController::class, 'store'])->name('.store'); // admin.kasir.store
            Route::get('/nota/{id}', [KasirController::class, 'nota'])->name('.nota'); // admin.kasir.nota
        });

        // ---------- Pengaturan Profil ----------
        Route::get('/pengaturan', [ProfileController::class, 'index'])->name('pengaturan');
        Route::put('/pengaturan', [ProfileController::class, 'update'])->name('pengaturan.update');

    });


// ============================================
// ROUTE LOGOUT
// ============================================
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
