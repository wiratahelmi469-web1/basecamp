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

<body class="font-sans antialiased bg-slate-50">
    <div class="min-h-screen flex flex-col justify-center items-center px-4">
        <div class="mb-6">
            <a href="{{ route('home') }}">
                <img
                    src="{{ asset('images/basecamp-logo.svg') }}"
                    alt="Basecamp Outdoor"
                    class="h-16 w-auto mx-auto">
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white/90 backdrop-blur-sm shadow-xl shadow-slate-200 overflow-hidden rounded-3xl border border-slate-200">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
