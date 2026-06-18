<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\ProdukTerlarisWidget;
use App\Filament\Widgets\PendapatanChart;
use App\Filament\Widgets\StatsOverview;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Firefly\FilamentBlog\Resources\Categories\CategoryResource;
use Firefly\FilamentBlog\Resources\Comments\CommentResource;
use Firefly\FilamentBlog\Resources\Posts\PostResource;
use Firefly\FilamentBlog\Resources\Tags\TagResource;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
                'danger' => Color::Rose,
                'info' => Color::Sky,
                'gray' => Color::Slate,
            ])
            ->font('Plus Jakarta Sans')
            ->brandName('')
            ->brandLogo(asset('images/basecamp-logo.svg'))
            ->brandLogoHeight('42px')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')

            /*
            |--------------------------------------------------------------------------
            | PENDAFTARAN RESOURCE FILAMENT BLOG (MANUAL & LENGKAP)
            |--------------------------------------------------------------------------
            | Kita daftarkan semua Resource bawaan Firefly secara eksplisit di sini
            | agar terhindar dari error 'Plugin class not found'.
            */
            ->resources([
                PostResource::class,
                CategoryResource::class,
                TagResource::class,
                CommentResource::class,
            ])

            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                StatsOverview::class,
                PendapatanChart::class,
                ProdukTerlarisWidget::class,
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
