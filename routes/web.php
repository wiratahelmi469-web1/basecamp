<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Models\Pembayaran;
use App\Models\Sewa;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/produk', [ProdukController::class, 'index'])
    ->name('produk.index');

Route::get('/produk/{produk}', [ProdukController::class, 'show'])
    ->name('produk.show');

/*
|--------------------------------------------------------------------------
| Customer Area (Laravel Breeze + Tailwind CSS)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard Customer / Redirector
    |--------------------------------------------------------------------------
    | KODE BARU: Rute ini dipasang agar URL '/customer' tidak lagi lari ke Filament,
    | melainkan otomatis menampilkan halaman indeks pesanan milik customer.
    */
    Route::get('/customer', [HomeController::class, 'index'])
        ->name('customer.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Keranjang
    |--------------------------------------------------------------------------
    */

    Route::get('/keranjang', [KeranjangController::class, 'index'])
        ->name('keranjang.index');

    Route::post('/keranjang', [KeranjangController::class, 'store'])
        ->name('keranjang.store');

    /*
    |--------------------------------------------------------------------------
    | Checkout
    |--------------------------------------------------------------------------
    */

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    /*
    |--------------------------------------------------------------------------
    | Pesanan
    |--------------------------------------------------------------------------
    */

    Route::get('/pesanan', function () {
        $sewas = Sewa::where(
            'user_id',
            auth()->id()
        )
            ->latest()
            ->get();

        return view(
            'customer.pesanan.index',
            compact('sewas')
        );
    })->name('pesanan.index');

    Route::get('/pesanan/{sewa}', function (Sewa $sewa) {
        $sewa->load([
            'detailPenyewaan.produk',
            'pembayaran',
        ]);

        return view(
            'customer.pesanan.show',
            compact('sewa')
        );
    })->name('pesanan.show');

    /*
    |--------------------------------------------------------------------------
    | Pembayaran
    |--------------------------------------------------------------------------
    */

    Route::get('/pembayaran', function () {
        $pembayaran = Pembayaran::whereHas(
            'sewa',
            fn($query) => $query->where(
                'user_id',
                auth()->id()
            )
        )
            ->latest()
            ->get();

        return view(
            'customer.pembayaran.index',
            compact('pembayaran')
        );
    })->name('pembayaran.index');

    Route::get(
        '/pembayaran/{sewa}',
        [PembayaranController::class, 'create']
    )->name('pembayaran.create');

    Route::post(
        '/pembayaran/{sewa}',
        [PembayaranController::class, 'store']
    )->name('pembayaran.store');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
