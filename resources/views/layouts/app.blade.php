<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#f8fafc] scroll-smooth">

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
        body {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
        }

        /* Tekstur grain halus di seluruh halaman — sentuhan premium tanpa mengubah palet warna */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            opacity: 0.025;
            mix-blend-mode: overlay;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='120' height='120' viewBox='0 0 120 120'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
        }

        /* Scrollbar tipis bertema slate/amber agar terasa lebih dirancang */
        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb {
            background-color: rgba(15, 23, 42, 0.18);
            background-image: linear-gradient(180deg, rgba(15,23,42,0.15), rgba(245,158,11,0.3));
            border-radius: 999px;
            border: 2px solid transparent;
            background-clip: content-box;
        }
        ::-webkit-scrollbar-thumb:hover { background-image: linear-gradient(180deg, rgba(15,23,42,0.25), rgba(245,158,11,0.45)); }
        html { scrollbar-color: rgba(245, 158, 11, 0.35) transparent; scrollbar-width: thin; }

        :focus-visible {
            outline: 2px solid rgb(245 158 11);
            outline-offset: 2px;
            border-radius: 6px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes ambientPulse {
            0%, 100% { opacity: 0.55; transform: scale(1); }
            50% { opacity: 0.9; transform: scale(1.06); }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>

<body class="antialiased text-slate-900 h-full bg-gradient-to-br from-slate-50 via-white to-slate-100/50 flex flex-col justify-between selection:bg-amber-500 selection:text-white">

    <div class="relative z-10 min-h-screen flex flex-col">
        <div
            x-data="{ scrolled: false }"
            @scroll.window="scrolled = (window.scrollY > 8)"
            :class="scrolled ? 'shadow-md border-slate-300/70' : 'shadow-[0_2px_15px_-3px_rgba(0,0,0,0.02)] border-slate-200/60'"
            class="sticky top-0 z-40 backdrop-blur-md bg-white/80 border-b transition-shadow duration-300"
        >
            @include('layouts.navigation')
        </div>

        @isset($header)
        <header class="relative overflow-hidden bg-slate-900 py-8 px-4 sm:px-6 lg:px-8 shadow-inner before:absolute before:inset-x-0 before:top-0 before:h-px before:bg-gradient-to-r before:from-transparent before:via-amber-500/40 before:to-transparent">
            <div class="absolute top-0 right-0 -mt-12 -mr-12 w-72 h-72 bg-amber-500/10 rounded-full blur-3xl pointer-events-none animate-[ambientPulse_10s_ease-in-out_infinite]"></div>
            <div class="absolute bottom-0 left-0 -mb-16 -ml-16 w-96 h-96 bg-emerald-500/5 rounded-full blur-3xl pointer-events-none animate-[ambientPulse_13s_ease-in-out_infinite_1.5s]"></div>

            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 relative z-10">
                <div>
                    <span
                        class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-amber-500 mb-1 opacity-0 animate-[fadeSlideUp_0.6s_ease-out_0.05s_forwards]"
                    >
                        <span class="relative flex h-1.5 w-1.5">
                            <span class="absolute inline-flex h-full w-full rounded-full bg-amber-500 opacity-75 animate-ping"></span>
                            <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                        </span>
                        Customer Portal
                    </span>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight opacity-0 animate-[fadeSlideUp_0.6s_ease-out_0.15s_forwards]">
                        {{ $header }}
                    </h1>
                </div>

                <div class="flex items-center gap-3 opacity-0 animate-[fadeSlideUp_0.6s_ease-out_0.25s_forwards]">
                    <a href="{{ route('produk.index') }}" class="group relative inline-flex items-center gap-2 overflow-hidden text-sm font-semibold bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white px-5 py-2.5 rounded-xl transition-all duration-300 shadow-[0_4px_14px_rgba(245,158,11,0.3)] hover:shadow-[0_6px_20px_rgba(245,158,11,0.4)] hover:-translate-y-0.5 focus-visible:ring-2 focus-visible:ring-amber-400 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900">
                        <span class="absolute inset-0 -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-out bg-gradient-to-r from-transparent via-white/25 to-transparent pointer-events-none"></span>
                        <i class="relative z-10 fa-solid fa-store text-xs"></i>
                        <span class="relative z-10">Jelajahi Alat Outdoor</span>
                    </a>
                </div>
            </div>
        </header>
        @endisset

        <main class="flex-1 max-w-7xl w-full mx-auto py-10 px-4 sm:px-6 lg:px-8 mb-20 md:mb-0 animate-[fadeIn_0.4s_ease-out]">
            <div class="bg-white/70 backdrop-blur-sm rounded-3xl border border-slate-200/80 p-6 md:p-10 shadow-[inset_0_1px_0_0_rgba(255,255,255,0.8),0_8px_30px_rgb(0,0,0,0.02)] hover:shadow-[inset_0_1px_0_0_rgba(255,255,255,0.9),0_12px_36px_rgb(0,0,0,0.05)] transition-shadow duration-500">
                {{ $slot }}
            </div>
        </main>
    </div>

    <div class="fixed bottom-0 left-0 right-0 bg-white/90 backdrop-blur-lg border-t border-slate-100/80 px-6 py-2.5 pb-[calc(0.625rem+env(safe-area-inset-bottom))] flex justify-around items-center md:hidden z-50 shadow-[inset_0_1px_0_0_rgba(255,255,255,0.9),0_-8px_30px_rgba(0,0,0,0.06)] rounded-t-3xl">
        <a href="{{ route('home') }}" class="group flex flex-col items-center gap-1 {{ request()->routeIs('home') ? 'text-amber-500 font-semibold' : 'text-slate-400 hover:text-slate-600' }} transition-colors active:scale-90">
            <span class="flex items-center justify-center w-10 h-7 rounded-xl transition-all duration-300 {{ request()->routeIs('home') ? 'bg-amber-50 ring-1 ring-amber-200/70' : '' }}">
                <i class="fa-solid fa-house-chimney text-lg"></i>
            </span>
            <span class="text-[10px] tracking-wide">Home</span>
        </a>
        <a href="{{ route('keranjang.index') }}" class="group flex flex-col items-center gap-1 {{ request()->routeIs('keranjang.*') ? 'text-amber-500 font-semibold' : 'text-slate-400 hover:text-slate-600' }} transition-colors relative active:scale-90">
            <span class="flex items-center justify-center w-10 h-7 rounded-xl transition-all duration-300 {{ request()->routeIs('keranjang.*') ? 'bg-amber-50 ring-1 ring-amber-200/70' : '' }}">
                <i class="fa-solid fa-bag-shopping text-lg"></i>
            </span>
            <span class="text-[10px] tracking-wide">Keranjang</span>
        </a>
        <a href="{{ route('pesanan.index') }}" class="group flex flex-col items-center gap-1 {{ request()->routeIs('pesanan.*') ? 'text-amber-500 font-semibold' : 'text-slate-400 hover:text-slate-600' }} transition-colors active:scale-90">
            <span class="flex items-center justify-center w-10 h-7 rounded-xl transition-all duration-300 {{ request()->routeIs('pesanan.*') ? 'bg-amber-50 ring-1 ring-amber-200/70' : '' }}">
                <i class="fa-solid fa-receipt text-lg"></i>
            </span>
            <span class="text-[10px] tracking-wide">Pesanan</span>
        </a>
        <a href="{{ route('filamentblog.post.index') }}" class="group flex flex-col items-center gap-1 text-slate-400 hover:text-slate-600 transition-colors active:scale-90">
            <span class="flex items-center justify-center w-10 h-7 rounded-xl transition-all duration-300">
                <i class="fa-solid fa-compass text-lg group-hover:scale-110 transition-transform duration-300"></i>
            </span>
            <span class="text-[10px] tracking-wide">Edu-Blog</span>
        </a>
    </div>
    @stack('scripts')
</body>

</html>
