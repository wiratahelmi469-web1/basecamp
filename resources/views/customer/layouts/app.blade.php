<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Basecamp Outdoor</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900">

    <nav class="sticky top-0 z-50 bg-white border-b shadow-sm">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex items-center justify-between h-20">

                {{-- Logo --}}
                <a
                    href="{{ route('home') }}"
                    class="text-2xl font-bold text-green-600">

                    Basecamp

                </a>

                {{-- Search --}}
                <form
                    action="{{ route('produk.index') }}"
                    method="GET"
                    class="hidden md:block flex-1 max-w-2xl mx-10">

                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Cari perlengkapan outdoor..."
                        class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500">

                </form>

                {{-- Menu --}}
                <div class="flex items-center gap-6">

                    <a
                        href="{{ route('produk.index') }}"
                        class="hover:text-green-600">

                        Produk

                    </a>

                    <a
                        href="/blogs"
                        class="hover:text-green-600">

                        Blog

                    </a>



                    </a>

                    {{-- Pesanan --}}
                    <a
                        href="/customer"
                        class="hover:text-green-600">

                        Pesanan

                    </a>

                    {{-- User --}}
                    <div class="flex items-center gap-2">
                        @auth

                        <div
                            x-data="{ open:false }"
                            class="relative">

                            <button
                                @click="open = !open"
                                class="flex items-center gap-3">

                                <div
                                    class="w-10 h-10 rounded-full bg-green-600 text-white flex items-center justify-center font-bold">

                                    {{ strtoupper(substr(auth()->user()->name ?? auth()->user()->nama,0,1)) }}

                                </div>

                                <span class="font-medium">

                                    {{ auth()->user()->name ?? auth()->user()->nama }}

                                </span>

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>

                                </svg>

                            </button>

                            <div
                                x-show="open"
                                @click.away="open = false"
                                x-transition
                                class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border overflow-hidden">

                                <div class="p-4 border-b">

                                    <p class="font-semibold">
                                        {{ auth()->user()->name ?? auth()->user()->nama }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ auth()->user()->email }}
                                    </p>

                                </div>

                                <a
                                    href="{{ route('pesanan.index') }}"
                                    class="block px-4 py-3 hover:bg-gray-100">

                                    📦 Pesanan Saya

                                </a>

                                <a
                                    href="{{ route('pembayaran.index') }}"
                                    class="block px-4 py-3 hover:bg-gray-100">

                                    💳 Pembayaran

                                </a>

                                <a
                                    href="{{ route('profile.edit') }}"
                                    class="block px-4 py-3 hover:bg-gray-100">

                                    👤 Profil

                                </a>

                                <div class="border-t"></div>

                                <form
                                    method="POST"
                                    action="{{ route('logout') }}">

                                    @csrf

                                    <button
                                        type="submit"
                                        class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50 transition">

                                        🚪 Logout

                                    </button>

                                </form>

                            </div>

                        </div>

                        @else

                        <a
                            href="{{ route('login') }}"
                            class="bg-green-600 text-white px-5 py-2 rounded-xl">

                            Login

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
