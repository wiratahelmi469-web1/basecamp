<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Keranjang;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {

            $cartCount = 0;

            if (auth()->check()) {

                $cartCount = Keranjang::where(
                    'user_id',
                    auth()->id()
                )->sum('jumlah');
            }

            $view->with('cartCount', $cartCount);
        });
    }
}
