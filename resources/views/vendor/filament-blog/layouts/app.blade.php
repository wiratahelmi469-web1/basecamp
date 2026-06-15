<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ $setting?->faviconImage }}" type="image/x-icon" />
    {!! \Firefly\FilamentBlog\Facades\SEOMeta::generate() !!}
    {!! $setting?->google_console_code !!}
    {!! $setting?->google_analytic_code !!}
    {!! $setting?->google_adsense_code !!}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', 'Inter', sans-serif; background-color: #f8fafc; }

        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        article h1 { line-height: 1.2; font-size: 2.25rem; color: #1e293b; font-weight: 800; padding-bottom: 20px; }
        article h2 { line-height: 1.3; font-size: 1.75rem; color: #334155; font-weight: 700; padding-top: 1.5rem; padding-bottom: 10px; }
        article h3 { line-height: 1.3; font-size: 1.4rem; color: #334155; font-weight: 600; padding-top: 1rem; padding-bottom: 10px; }
        article p  { line-height: 1.8; letter-spacing: .1px; font-size: 1.05rem; color: #475569; margin-bottom: 1.25rem; }
        article ul { line-height: 1.8; padding-left: 1.5rem; list-style-type: disc; margin-bottom: 1.25rem; color: #475569; }
        article table { margin: 2rem 0; width: 100%; border-collapse: collapse; border-radius: 8px; overflow: hidden; }
        article table td, article table th { border: 1px solid #e2e8f0; padding: 10px 14px; }
        article table th { background-color: #f1f5f9; color: #1e293b; font-weight: 600; }
    </style>
</head>

<body class="antialiased text-slate-900 bg-gradient-to-br from-slate-50 via-white to-slate-100/50 flex flex-col min-h-screen selection:bg-amber-500 selection:text-white">

    {{-- ======================== NAVBAR (sama persis dengan main app) ======================== --}}
    <div class="sticky top-0 z-40 backdrop-blur-md bg-white/80 border-b border-slate-200/60 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.02)]">
        <nav x-data="{ open: false }" class="bg-transparent">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between py-3">

                    {{-- LOGO --}}
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
                        <div class="w-9 h-9 bg-slate-900 rounded-xl flex items-center justify-center shadow-sm group-hover:bg-slate-800 transition-colors duration-200">
                            <i class="fa-solid fa-campground text-amber-400 text-sm"></i>
                        </div>
                        <div class="flex flex-col leading-none">
                            <span class="font-extrabold text-[17px] text-slate-900 tracking-tight">Basecamp</span>
                            <span class="text-[9px] font-bold text-amber-500 tracking-[0.18em] uppercase">Outdoor</span>
                        </div>
                    </a>

                    {{-- DESKTOP NAV LINKS --}}
                    <div class="hidden md:flex items-center gap-1">
                        @php
                            $links = [
                                ['route' => 'home',                     'match' => 'home',            'label' => 'Beranda'],
                                ['route' => 'produk.index',             'match' => 'produk.*',        'label' => 'Katalog'],
                                ['route' => 'filamentblog.post.index',  'match' => 'filamentblog.*',  'label' => 'Edu-Blog'],
                                ['route' => 'pesanan.index',            'match' => 'pesanan.*',       'label' => 'Pesanan'],
                            ];
                        @endphp
                        @foreach ($links as $link)
                            <a href="{{ route($link['route']) }}"
                               class="relative px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
                                      {{ request()->routeIs($link['match'])
                                          ? 'text-slate-900 bg-amber-50'
                                          : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50' }}">
                                {{ $link['label'] }}
                                @if (request()->routeIs($link['match']))
                                    <span class="absolute bottom-0.5 left-1/2 -translate-x-1/2 w-4 h-0.5 bg-amber-500 rounded-full"></span>
                                @endif
                            </a>
                        @endforeach
                    </div>

                    {{-- RIGHT SECTION --}}
                    <div class="flex items-center gap-2">
                        @auth
                            @php $cartCount = count(session('cart', [])); @endphp
                            <a href="{{ route('keranjang.index') }}"
                               class="relative w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:text-amber-500 hover:bg-amber-50 transition-all duration-200">
                                <i class="fa-solid fa-basket-shopping text-base"></i>
                                @if ($cartCount > 0)
                                    <span class="absolute -top-0.5 -right-0.5 min-w-[16px] h-4 px-1 bg-amber-500 text-white text-[9px] font-bold rounded-full flex items-center justify-center leading-none">
                                        {{ $cartCount > 9 ? '9+' : $cartCount }}
                                    </span>
                                @endif
                            </a>

                            <div class="hidden md:block relative" x-data="{ dropOpen: false }">
                                <button @click="dropOpen = !dropOpen" @click.outside="dropOpen = false"
                                        class="flex items-center gap-2.5 pl-2 pr-3 py-1.5 rounded-xl border border-slate-200/80 hover:bg-slate-50 hover:border-slate-300 transition-all duration-200 text-sm font-semibold text-slate-700">
                                    <div class="w-7 h-7 rounded-full bg-slate-900 flex items-center justify-center text-amber-400 text-xs font-bold shrink-0">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <span class="max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                                    <i class="fa-solid fa-chevron-down text-[9px] text-slate-400 transition-transform duration-200" :class="{ 'rotate-180': dropOpen }"></i>
                                </button>

                                <div x-show="dropOpen"
                                     x-transition:enter="transition ease-out duration-150"
                                     x-transition:enter-start="opacity-0 translate-y-1"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-100"
                                     x-transition:leave-start="opacity-100 translate-y-0"
                                     x-transition:leave-end="opacity-0 translate-y-1"
                                     class="absolute right-0 mt-2 w-52 bg-white rounded-xl border border-slate-200/80 shadow-lg shadow-slate-200/50 py-1.5 z-50"
                                     style="display: none;">
                                    <div class="px-3 py-2 border-b border-slate-100 mb-1">
                                        <p class="text-xs font-bold text-slate-900 truncate">{{ Auth::user()->name }}</p>
                                        <p class="text-[11px] text-slate-400 truncate">{{ Auth::user()->email }}</p>
                                    </div>
                                    <a href="{{ route('pesanan.index') }}" class="flex items-center gap-2.5 px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors">
                                        <i class="fa-solid fa-receipt text-slate-400 w-4 text-center text-xs"></i> Transaksi Saya
                                    </a>
                                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors">
                                        <i class="fa-solid fa-user-pen text-slate-400 w-4 text-center text-xs"></i> Pengaturan Akun
                                    </a>
                                    <div class="border-t border-slate-100 mt-1 pt-1">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 text-sm text-rose-500 hover:bg-rose-50 transition-colors font-medium">
                                                <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center text-xs"></i> Keluar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="hidden md:flex items-center gap-2">
                                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold text-slate-600 hover:text-slate-900 rounded-lg hover:bg-slate-50 transition-all duration-200">
                                    Masuk
                                </a>
                                <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-semibold text-white bg-amber-500 hover:bg-amber-600 rounded-lg transition-all duration-200 shadow-sm shadow-amber-200">
                                    Daftar
                                </a>
                            </div>
                        @endauth

                        {{-- Mobile Hamburger --}}
                        <button @click="open = !open"
                                class="md:hidden w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition-all duration-200">
                            <i class="fa-solid text-base" :class="open ? 'fa-xmark' : 'fa-bars'"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- MOBILE MENU --}}
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="md:hidden border-t border-slate-100 bg-white"
                 style="display: none;">
                <div class="px-4 py-3 space-y-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors">
                        <i class="fa-solid fa-house-chimney w-4 text-center"></i> Beranda
                    </a>
                    <a href="{{ route('produk.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors">
                        <i class="fa-solid fa-store w-4 text-center"></i> Katalog Sewa
                    </a>
                    <a href="{{ route('filamentblog.post.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium bg-amber-50 text-amber-600">
                        <i class="fa-solid fa-compass w-4 text-center"></i> Edu-Blog
                    </a>
                    <a href="{{ route('filamentblog.post.all') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors">
                        <i class="fa-solid fa-newspaper w-4 text-center"></i> Semua Artikel
                    </a>
                    @auth
                    <a href="{{ route('pesanan.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors">
                        <i class="fa-solid fa-receipt w-4 text-center"></i> Pesanan Saya
                    </a>
                    @endauth
                </div>
                @auth
                <div class="px-4 pb-4 border-t border-slate-100 mt-1 pt-3 space-y-1">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors">
                        <i class="fa-solid fa-user-pen w-4 text-center"></i> Pengaturan Akun
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-rose-500 hover:bg-rose-50 transition-colors">
                            <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i> Keluar
                        </button>
                    </form>
                </div>
                @else
                <div class="px-4 pb-4 border-t border-slate-100 mt-1 pt-3 flex gap-2">
                    <a href="{{ route('login') }}" class="flex-1 text-center py-2.5 text-sm font-semibold border border-slate-200 rounded-xl text-slate-700 hover:bg-slate-50 transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="flex-1 text-center py-2.5 text-sm font-semibold bg-amber-500 hover:bg-amber-600 text-white rounded-xl transition-colors">Daftar</a>
                </div>
                @endauth
            </div>
        </nav>
    </div>

    {{-- ======================== BLOG HERO (hanya di halaman index) ======================== --}}
    @if(request()->routeIs('filamentblog.post.index'))
        <section class="bg-slate-900 text-white py-12 md:py-20 px-4 relative overflow-hidden">
            <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:20px_20px]"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-slate-700/30 rounded-full blur-3xl pointer-events-none"></div>

            <div class="max-w-4xl mx-auto text-center relative z-10">
                <span class="inline-block text-xs font-bold tracking-widest text-amber-400 uppercase bg-amber-500/10 border border-amber-500/20 px-4 py-1.5 rounded-full mb-5">
                    Panduan & Inspirasi Petualangan
                </span>
                <h1 class="text-3xl md:text-5xl font-extrabold mt-2 tracking-tight leading-tight">
                    Eksplor Alam Liar dengan
                    <span class="text-amber-400"> Persiapan Matang</span>
                </h1>
                <p class="text-sm md:text-lg text-slate-300 mt-5 max-w-2xl mx-auto font-normal leading-relaxed">
                    Tips mendaki, review alat outdoor, rute gunung, hingga panduan bertahan hidup dari tim Basecamp Outdoor.
                </p>
            </div>
        </section>
    @endif

    {{-- ======================== MAIN CONTENT ======================== --}}
    <main class="flex-grow">
        {{ $slot }}
    </main>

    {{-- ======================== FOOTER ======================== --}}
    <footer class="bg-slate-900 text-slate-400 border-t border-slate-800 px-4 py-12 sm:py-16 mt-16">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-slate-800 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-campground text-amber-400 text-sm"></i>
                    </div>
                    <div class="flex flex-col leading-none">
                        <span class="font-extrabold text-[16px] text-white tracking-tight">Basecamp</span>
                        <span class="text-[9px] font-bold text-amber-500 tracking-[0.18em] uppercase">Outdoor</span>
                    </div>
                </div>
                <p class="text-sm leading-relaxed text-slate-400">
                    {{ $setting?->description ?? 'Penyedia layanan sewa alat outdoor premium dan terpercaya.' }}
                </p>
            </div>

            <div class="flex flex-col gap-4">
                <h4 class="text-sm font-semibold text-slate-200 uppercase tracking-wider">Tautan Cepat</h4>
                <div class="grid grid-cols-1 gap-2.5 text-sm">
                    @forelse($setting->quick_links ?? [] as $link)
                        <a href="{{ $link['url'] }}" class="hover:text-amber-400 transition-colors">{{ $link['label'] }}</a>
                    @empty
                        <a href="{{ route('produk.index') }}" class="hover:text-amber-400 transition-colors">Katalog Rental Alat</a>
                        <a href="{{ route('filamentblog.post.all') }}" class="hover:text-amber-400 transition-colors">Semua Artikel Blog</a>
                        <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">Halaman Utama</a>
                    @endforelse
                </div>
            </div>

            <div class="flex flex-col gap-4">
                <h4 class="text-sm font-semibold text-slate-200 uppercase tracking-wider">Newsletter</h4>
                <p class="text-sm text-slate-400">Dapatkan tips outdoor dan promo sewa terbaru langsung ke email kamu.</p>
                <form method="post" action="{{ route('filamentblog.post.subscribe') }}" class="mt-1">
                    @csrf
                    @error('email')
                        <span class="text-xs text-rose-400 mb-1 block">{{ $message }}</span>
                    @enderror
                    <div class="relative flex items-center">
                        <input autocomplete="email" name="email" value="{{ old('email') }}"
                               placeholder="Alamat email Anda..."
                               type="email"
                               class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3.5 text-sm text-white outline-none focus:border-amber-500/60 placeholder:text-slate-500 transition">
                        <button type="submit" class="absolute right-2 p-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg transition">
                            <i class="fa-solid fa-arrow-right text-sm"></i>
                        </button>
                    </div>
                    @if (session('success'))
                        <span class="text-xs text-emerald-400 mt-2 block">{{ session('success') }}</span>
                    @endif
                </form>
            </div>
        </div>

        <div class="max-w-7xl mx-auto mt-12 pt-6 border-t border-slate-800 text-center text-xs text-slate-500">
            © {{ now()->year }} {{ $setting->organization_name ?? 'Basecamp Outdoor' }}. Hak Cipta Dilindungi.
        </div>
    </footer>

    {{-- ======================== MOBILE BOTTOM NAV ======================== --}}
    <div class="fixed bottom-0 left-0 right-0 bg-white/90 backdrop-blur-lg border-t border-slate-100/80 px-6 py-2.5 flex justify-around items-center md:hidden z-50 shadow-[0_-8px_30px_rgba(0,0,0,0.06)] rounded-t-3xl">
        <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 text-slate-400 hover:text-slate-600 transition-colors">
            <i class="fa-solid fa-house-chimney text-lg"></i>
            <span class="text-[10px] tracking-wide">Home</span>
        </a>
        <a href="{{ route('keranjang.index') }}" class="flex flex-col items-center gap-1 text-slate-400 hover:text-slate-600 transition-colors relative">
            <i class="fa-solid fa-basket-shopping text-lg"></i>
            <span class="text-[10px] tracking-wide">Keranjang</span>
        </a>
        <a href="{{ route('filamentblog.post.index') }}"
           class="flex flex-col items-center gap-1 {{ request()->routeIs('filamentblog.*') ? 'text-amber-500 font-semibold' : 'text-slate-400 hover:text-slate-600' }} transition-colors">
            <i class="fa-solid fa-compass text-lg"></i>
            <span class="text-[10px] tracking-wide">Edu-Blog</span>
        </a>
        <a href="{{ route('pesanan.index') }}"
           class="flex flex-col items-center gap-1 {{ request()->routeIs('pesanan.*') ? 'text-amber-500 font-semibold' : 'text-slate-400 hover:text-slate-600' }} transition-colors">
            <i class="fa-solid fa-receipt text-lg"></i>
            <span class="text-[10px] tracking-wide">Pesanan</span>
        </a>
    </div>

    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("comment-box").submit();
        }
    </script>
</body>
</html>
