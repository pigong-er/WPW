<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::post('/product', [ProductController::class, 'store']);
Route::put('/product/{id}', [ProductController::class, 'update']);
Route::delete('/product/{id}', [ProductController::class, 'destroy']);


// 1. Halaman Frontend
Route::get('/', function () {
    return view('welcome');
});

// 2. Halaman Login
Route::get('/login', function () {
    return view('auth.login');
});

// 3. Halaman Admin Dashboard
Route::get('/admin', function () {
    return view('admin.dashboard');
});
