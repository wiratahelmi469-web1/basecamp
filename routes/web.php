<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KeranjangController;

Route::middleware('auth')->group(function () {

    Route::get('/keranjang', [KeranjangController::class, 'index'])
        ->name('keranjang.index');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/produk', [ProdukController::class, 'index'])
    ->name('produk.index');

Route::get('/produk/{produk}', [ProdukController::class, 'show'])
    ->name('produk.show');

Route::middleware('auth')->group(function () {

    Route::get('/keranjang', [KeranjangController::class, 'index'])
        ->name('keranjang.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
