<?php

use Illuminate\Support\Facades\Route;

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
