<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div
        class="relative min-h-screen flex flex-col items-center justify-center px-4 py-10
            bg-cover bg-center bg-fixed"
        style="background-image: url('{{ asset('images/mountain.jpg') }}');">

        {{-- Overlay agar konten tetap terbaca --}}
        <div class="absolute inset-0 bg-slate-900/50"></div>

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="relative z-10 mb-6">
            <img
                src="{{ asset('images/basecamp-logo.svg') }}"
                alt="Basecamp Outdoor"
                class="h-16 w-auto">
        </a>

        {{-- Form Card --}}
        <div
            class="relative z-10 w-full sm:max-w-md
                px-8 py-8
                bg-white/85
                backdrop-blur-md
                rounded-3xl
                shadow-2xl
                border border-white/30">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
