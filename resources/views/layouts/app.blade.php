<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#f8fafc]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Basecamp Outdoor') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Plus Jakarta Sans', 'Inter', sans-serif; }
        </style>
    </head>
    <body class="antialiased text-slate-900 h-full bg-gradient-to-br from-slate-50 via-white to-slate-100/50 flex flex-col justify-between selection:bg-amber-500 selection:text-white">

        <div class="min-h-screen flex flex-col">
            <div class="sticky top-0 z-40 backdrop-blur-md bg-white/80 border-b border-slate-200/60 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.02)]">
                @include('layouts.navigation')
            </div>

            @isset($header)
                <header class="relative overflow-hidden bg-slate-900 py-8 px-4 sm:px-6 lg:px-8 shadow-inner">
                    <div class="absolute top-0 right-0 -mt-12 -mr-12 w-72 h-72 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 -mb-16 -ml-16 w-96 h-96 bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>

                    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 relative z-10">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-widest text-amber-500 mb-1 block">Customer Portal</span>
                            <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">
                                {{ $header }}
                            </h1>
                        </div>

                        <div class="flex items-center gap-3">
                            <a href="{{ route('produk.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white px-5 py-2.5 rounded-xl transition-all duration-300 shadow-[0_4px_14px_rgba(245,158,11,0.3)] hover:shadow-[0_6px_20px_rgba(245,158,11,0.4)] hover:-translate-y-0.5">
                                <i class="fa-solid fa-store text-xs"></i> Jelajahi Alat Outdoor
                            </a>
                        </div>
                    </div>
                </header>
            @endisset

            <main class="flex-1 max-w-7xl w-full mx-auto py-10 px-4 sm:px-6 lg:px-8 mb-20 md:mb-0 animate-[fadeIn_0.4s_ease-out]">
                <div class="bg-white/70 backdrop-blur-sm rounded-3xl border border-slate-200/80 p-6 md:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.02)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] transition-shadow duration-500">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <div class="fixed bottom-0 left-0 right-0 bg-white/90 backdrop-blur-lg border-t border-slate-100/80 px-6 py-2.5 flex justify-around items-center md:hidden z-50 shadow-[0_-8px_30px_rgba(0,0,0,0.06)] rounded-t-3xl">
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('home') ? 'text-amber-500 font-semibold' : 'text-slate-400 hover:text-slate-600' }} transition-colors">
                <i class="fa-solid fa-house-chimney text-lg"></i>
                <span class="text-[10px] tracking-wide">Home</span>
            </a>
            <a href="{{ route('keranjang.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('keranjang.*') ? 'text-amber-500 font-semibold' : 'text-slate-400 hover:text-slate-600' }} transition-colors relative">
                <i class="fa-solid fa-bag-shopping text-lg"></i>
                <span class="text-[10px] tracking-wide">Keranjang</span>
            </a>
            <a href="{{ route('pesanan.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('pesanan.*') ? 'text-amber-500 font-semibold' : 'text-slate-400 hover:text-slate-600' }} transition-colors">
                <i class="fa-solid fa-receipt text-lg"></i>
                <span class="text-[10px] tracking-wide">Pesanan</span>
            </a>
            <a href="{{ route('filamentblog.post.index') }}" class="flex flex-col items-center gap-1 text-slate-400 hover:text-slate-600 transition-colors">
                <i class="fa-solid fa-compass text-lg"></i>
                <span class="text-[10px] tracking-wide">Edu-Blog</span>
            </a>
        </div>

    </body>
</html>
