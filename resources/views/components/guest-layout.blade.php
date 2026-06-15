<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Basecamp Outdoor') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="antialiased min-h-screen">

    <div class="min-h-screen flex">

        {{-- Kiri: Background Pegunungan --}}
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200&q=80"
                 alt="Pegunungan"
                 class="absolute inset-0 w-full h-full object-cover">

            {{-- Overlay gradient --}}
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900/80 via-slate-900/60 to-slate-800/30"></div>

            {{-- Konten overlay --}}
            <div class="relative z-10 flex flex-col justify-between p-12 w-full">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fa-solid fa-tent text-white text-lg"></i>
                    </div>
                    <span class="text-white font-extrabold text-xl tracking-tight">Basecamp Outdoor</span>
                </a>

                {{-- Tagline --}}
                <div>
                    <span class="text-xs font-bold uppercase tracking-[4px] text-amber-400">
                        Petualangan Dimulai di Sini
                    </span>
                    <h2 class="text-4xl font-extrabold text-white mt-4 leading-snug">
                        Sewa Perlengkapan<br>Outdoor Terpercaya
                    </h2>
                    <p class="text-slate-300 mt-4 leading-relaxed text-sm max-w-sm">
                        Dari tenda hingga carrier, semua tersedia dengan harga terjangkau dan kualitas terjamin.
                    </p>

                    {{-- Stats --}}
                    <div class="flex gap-8 mt-10 pt-8 border-t border-white/10">
                        <div>
                            <p class="text-2xl font-extrabold text-white">500+</p>
                            <p class="text-slate-400 text-xs mt-0.5">Transaksi</p>
                        </div>
                        <div>
                            <p class="text-2xl font-extrabold text-white">120+</p>
                            <p class="text-slate-400 text-xs mt-0.5">Peralatan</p>
                        </div>
                        <div>
                            <p class="text-2xl font-extrabold text-white">98%</p>
                            <p class="text-slate-400 text-xs mt-0.5">Puas</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Kanan: Form --}}
        <div class="w-full lg:w-1/2 flex flex-col min-h-screen bg-slate-50">

            {{-- Mobile: Logo --}}
            <div class="lg:hidden px-6 pt-8 pb-4">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
                    <div class="w-9 h-9 bg-amber-500 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-tent text-white"></i>
                    </div>
                    <span class="font-extrabold text-slate-900 text-lg">Basecamp Outdoor</span>
                </a>
            </div>

            {{-- Mobile: hero image strip --}}
            <div class="lg:hidden h-40 relative overflow-hidden mx-6 rounded-2xl mb-4">
                <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=800&q=80"
                     alt="Pegunungan" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-slate-900/50 flex items-center justify-center">
                    <p class="text-white font-bold text-lg">Petualangan Dimulai di Sini</p>
                </div>
            </div>

            {{-- Form Area --}}
            <div class="flex-1 flex items-center justify-center px-6 py-8">
                <div class="w-full max-w-md">
                    <div class="bg-white rounded-3xl shadow-[0_8px_40px_rgba(0,0,0,0.08)] border border-slate-100 p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <p class="text-center text-xs text-slate-400 py-6">
                &copy; {{ date('Y') }} Basecamp Outdoor. All rights reserved.
            </p>

        </div>

    </div>

</body>
</html>
