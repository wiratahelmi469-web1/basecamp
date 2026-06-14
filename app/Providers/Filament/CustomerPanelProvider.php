<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class CustomerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('customer')
            /* |--------------------------------------------------------------------------
            | 1. UBAH PATH AGAR TIDAK MENABRAK BREEZE
            |--------------------------------------------------------------------------
            | Mengubah 'customer' menjadi 'customer-admin' agar rute '/customer'
            | bisa digunakan sepenuhnya oleh Laravel Breeze + Tailwind CSS Anda.
            */
            ->path('customer-admin')

            ->login()
            ->brandName('Basecamp Customer')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(
                in: app_path('Filament/Customer/Resources'),
                for: 'App\\Filament\\Customer\\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/Customer/Pages'),
                for: 'App\\Filament\\Customer\\Pages'
            )
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(
                in: app_path('Filament/Customer/Widgets'),
                for: 'App\\Filament\\Customer\\Widgets'
            )
            /* |--------------------------------------------------------------------------
            | 2. HAPUS / KOMENTARI WIDGET YANG ERROR
            |--------------------------------------------------------------------------
            | Class 'CustomerStats::class' dihapus dari array ini karena filenya tidak
            | ditemukan atau jalurnya salah, yang menyebabkan Internal Server Error.
            */
            ->widgets([
                // \App\Filament\Customer\Widgets\CustomerStats::class, (Dikomit karena tidak ditemukan)
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
