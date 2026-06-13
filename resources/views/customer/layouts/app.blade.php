<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Basecamp Outdoor</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900">

<nav class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-200">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-center justify-between h-20">

            <a href="{{ route('home') }}"
                class="font-bold text-2xl text-green-700">
                Basecamp Outdoor
            </a>

            <div class="flex items-center gap-8">

                <a href="{{ route('home') }}"
                    class="hover:text-green-600 transition">
                    Home
                </a>

                <a href="{{ route('produk.index') }}"
                    class="hover:text-green-600 transition">
                    Produk
                </a>

                <a href="/blogs"
                    class="hover:text-green-600 transition">
                    Blog
                </a>

                @auth

                    <a href="{{ route('keranjang.index') }}"
                        class="hover:text-green-600 transition">
                        Keranjang
                    </a>

                    <a href="{{ route('profile.edit') }}"
                        class="hover:text-green-600 transition">
                        Profil
                    </a>

                    <form method="POST"
                        action="{{ route('logout') }}">
                        @csrf

                        <button
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                            Logout
                        </button>
                    </form>

                @else

                    <a href="{{ route('login') }}"
                        class="hover:text-green-600 transition">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">
                        Daftar
                    </a>

                @endauth

            </div>

        </div>

    </div>

</nav>

<main class="pt-20">

    @yield('content')

</main>

</body>

</html>
