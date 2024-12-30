<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiMainController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/produk', [ApiMainController::class, 'index']);
// Route::get('/login', [ApiMainController::class, 'login'])->name('login');
Route::post('/login', [ApiMainController::class, 'prosesLogin']);
Route::post('/register', [ApiMainController::class, 'register']);

// authentication
Route::get('/cek-login', [ApiMainController::class, 'cekLogin']);

Route::get('/kategory', [ApiMainController::class, 'kategory']);
Route::get('/lihat-produk/{id}', [ApiMainController::class, 'lihatProduk']);

Route::get('/search/{parameter}', [ApiMainController::class, 'search']);

Route::get('/keranjang', [ApiMainController::class, 'keranjang']);

