<nav x-data="{ open: false, searchOpen: false }" class="bg-white/80 backdrop-blur-md border-b border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-18 py-3">

            {{-- ===================== LOGO ===================== --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
                <div class="w-9 h-9 bg-slate-900 rounded-xl flex items-center justify-center shadow-sm group-hover:bg-slate-800 transition-colors duration-200">
                    <i class="fa-solid fa-campground text-amber-400 text-sm"></i>
                </div>
                <div class="flex flex-col leading-none">
                    <span class="font-extrabold text-[17px] text-slate-900 tracking-tight">Basecamp</span>
                    <span class="text-[9px] font-bold text-amber-500 tracking-[0.18em] uppercase">Outdoor</span>
                </div>
            </a>

            {{-- ===================== DESKTOP NAV LINKS ===================== --}}
            <div class="hidden md:flex items-center gap-1">
                @php
                $links = [
                ['route' => 'home', 'match' => 'home', 'label' => 'Beranda'],
                ['route' => 'produk.index', 'match' => 'produk.*', 'label' => 'Katalog'],
                ['route' => 'filamentblog.post.index', 'match' => 'filamentblog.*','label' => 'Edu-Blog'],
                ['route' => 'pesanan.index', 'match' => 'pesanan.*', 'label' => 'Pesanan'],
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

            {{-- ===================== RIGHT SECTION ===================== --}}
            <div class="flex items-center gap-2">

                {{-- Cart Icon (hanya saat login) --}}
                @auth
                @php
                $cartCount = \App\Models\Keranjang::where('user_id', auth()->id())
                ->sum('jumlah');
                @endphp

                <a href="{{ route('keranjang.index') }}"
                    class="relative w-9 h-9 rounded-lg flex items-center justify-center text-slate-500
            hover:text-amber-500 hover:bg-amber-50 transition-all duration-200
            {{ request()->routeIs('keranjang.*') ? 'text-amber-500 bg-amber-50' : '' }}">

                    <i class="fa-solid fa-basket-shopping text-base"></i>

                    @if ($cartCount > 0)
                    <span class="absolute -top-1 -right-1 min-w-[18px] h-[18px]
                    bg-red-500 text-white text-[10px] font-bold
                    rounded-full flex items-center justify-center">
                        {{ $cartCount > 99 ? '99+' : $cartCount }}
                    </span>
                    @endif

                </a>
                @endauth

                {{-- User Dropdown (login) / Guest Buttons --}}
                @auth
                <div class="hidden md:block relative" x-data="{ dropOpen: false }">
                    <button @click="dropOpen = !dropOpen"
                        @click.outside="dropOpen = false"
                        class="flex items-center gap-2.5 pl-2 pr-3 py-1.5 rounded-xl border border-slate-200/80
                                hover:bg-slate-50 hover:border-slate-300 transition-all duration-200 text-sm font-semibold text-slate-700">
                        <div class="w-7 h-7 rounded-full bg-slate-900 flex items-center justify-center text-amber-400 text-xs font-bold shrink-0">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                        <i class="fa-solid fa-chevron-down text-[9px] text-slate-400 transition-transform duration-200"
                            :class="{ 'rotate-180': dropOpen }"></i>
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

                        <a href="{{ route('pesanan.index') }}"
                            class="flex items-center gap-2.5 px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                            <i class="fa-solid fa-receipt text-slate-400 w-4 text-center text-xs"></i>
                            Transaksi Saya
                        </a>
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-2.5 px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                            <i class="fa-solid fa-user-pen text-slate-400 w-4 text-center text-xs"></i>
                            Pengaturan Akun
                        </a>

                        <div class="border-t border-slate-100 mt-1 pt-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-2.5 px-3 py-2 text-sm text-rose-500 hover:bg-rose-50 hover:text-rose-600 transition-colors font-medium">
                                    <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center text-xs"></i>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <div class="hidden md:flex items-center gap-2">
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm font-semibold text-slate-600 hover:text-slate-900 rounded-lg hover:bg-slate-50 transition-all duration-200">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 text-sm font-semibold text-white bg-amber-500 hover:bg-amber-600 rounded-lg transition-all duration-200 shadow-sm shadow-amber-200">
                        Daftar
                    </a>
                </div>
                @endauth

                {{-- Mobile Hamburger --}}
                <button @click="open = !open"
                    class="md:hidden w-9 h-9 rounded-lg flex items-center justify-center text-slate-500
                               hover:text-slate-800 hover:bg-slate-50 transition-all duration-200">
                    <i class="fa-solid text-base" :class="open ? 'fa-xmark' : 'fa-bars'"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- ===================== MOBILE MENU ===================== --}}
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
            <a href="{{ route('home') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                      {{ request()->routeIs('home') ? 'bg-amber-50 text-amber-600' : 'text-slate-600 hover:bg-slate-50' }}">
                <i class="fa-solid fa-house-chimney w-4 text-center"></i> Beranda
            </a>
            <a href="{{ route('produk.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                      {{ request()->routeIs('produk.*') ? 'bg-amber-50 text-amber-600' : 'text-slate-600 hover:bg-slate-50' }}">
                <i class="fa-solid fa-store w-4 text-center"></i> Katalog Sewa
            </a>
            <a href="{{ route('filamentblog.post.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                      {{ request()->routeIs('filamentblog.*') ? 'bg-amber-50 text-amber-600' : 'text-slate-600 hover:bg-slate-50' }}">
                <i class="fa-solid fa-compass w-4 text-center"></i> Edu-Blog
            </a>
            <a href="{{ route('pesanan.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                      {{ request()->routeIs('pesanan.*') ? 'bg-amber-50 text-amber-600' : 'text-slate-600 hover:bg-slate-50' }}">
                <i class="fa-solid fa-receipt w-4 text-center"></i> Pesanan Saya
            </a>
        </div>

        @auth
        <div class="px-4 pb-4 border-t border-slate-100 mt-1 pt-3 space-y-1">
            <a href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors">
                <i class="fa-solid fa-user-pen w-4 text-center"></i> Pengaturan Akun
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-rose-500 hover:bg-rose-50 transition-colors">
                    <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i> Keluar
                </button>
            </form>
        </div>
        @else
        <div class="px-4 pb-4 border-t border-slate-100 mt-1 pt-3 flex gap-2">
            <a href="{{ route('login') }}" class="flex-1 text-center py-2.5 text-sm font-semibold border border-slate-200 rounded-xl text-slate-700 hover:bg-slate-50 transition-colors">
                Masuk
            </a>
            <a href="{{ route('register') }}" class="flex-1 text-center py-2.5 text-sm font-semibold bg-amber-500 hover:bg-amber-600 text-white rounded-xl transition-colors">
                Daftar
            </a>
        </div>
        @endauth
    </div>
</nav>
