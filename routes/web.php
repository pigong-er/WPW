<?php

use Illuminate\Support\Facades\Route;
use App\Models\AlatOutdoor;
use App\Http\Controllers\Admin\KatalogController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\AuthController;


//Route Frontend
// Menampilkan katalog dari database
Route::get('/', function () {
    $alat = AlatOutdoor::all();

    return view('welcome', compact('alat'));
});


// Route Login
// Menampilkan halaman login
Route::get('/login', [AuthController::class, 'index'])
    ->name('login');

// Memproses username dan password
Route::post('/login', [AuthController::class, 'authenticate'])
    ->name('login.authenticate');


// Route Admin Panel
Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

        // Dashboard admin
        Route::get('/', function () {
            return view('admin.dashboard');
        });

        // CRUD Katalog Alat
        Route::resource('katalog', KatalogController::class);

        // pengaturan
        Route::get('/pengaturan', [ProfileController::class, 'index'])
            ->name('admin.pengaturan');

        Route::put('/pengaturan', [ProfileController::class, 'update'])
            ->name('admin.pengaturan.update');

    });


// Route Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');
