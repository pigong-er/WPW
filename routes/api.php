<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\AuthController;

// ==========================================
// ROUTE PUBLIC (Tidak butuh token)
// ==========================================
Route::post('/login', [AuthController::class, 'loginApi']);

Route::apiResource('books', BookController::class);

// ==========================================
// ROUTE PROTECTED (Wajib bawa token Sanctum)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {

    // Mengecek data user yang sedang login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Logout dan menghapus token
    Route::post('/logout', [AuthController::class, 'logoutApi']);
});
