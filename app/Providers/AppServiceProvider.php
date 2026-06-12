<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\DetailPenyewaan;
use App\Models\Sewa;

use App\Observers\DetailPenyewaanObserver;
use App\Observers\SewaObserver;

use App\Models\Pembayaran;
use App\Observers\PembayaranObserver;

use App\Models\Post;
use App\Observers\PostObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DetailPenyewaan::observe(DetailPenyewaanObserver::class);

        Sewa::observe(SewaObserver::class);

        Pembayaran::observe(PembayaranObserver::class);

        Post::observe(PostObserver::class);
    }
}
