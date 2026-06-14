<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 bg-gradient-to-tr from-slate-900 to-slate-800 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                            <i class="fa-solid fa-campground text-amber-500 text-lg"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-extrabold text-lg text-slate-900 tracking-tight leading-tight">Basecamp</span>
                            <span class="text-[10px] font-bold text-amber-600 tracking-widest uppercase">Outdoor</span>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-amber-500 text-slate-900 font-semibold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }} text-sm transition-all">
                        Beranda
                    </a>
                    <a href="{{ route('produk.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('produk.*') ? 'border-amber-500 text-slate-900 font-semibold' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }} text-sm transition-all">
                        Katalog Sewa
                    </a>
                    <a href="{{ route('filamentblog.post.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 text-sm transition-all">
                        Edu-Blog
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                <a href="{{ route('keranjang.index') }}" class="relative w-10 h-10 rounded-xl border border-slate-200/60 flex items-center justify-center text-slate-600 hover:bg-slate-50 hover:text-amber-500 transition-all">
                    <i class="fa-solid fa-basket-shopping text-base"></i>
                    <span class="absolute -top-1 -right-1 bg-amber-500 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center shadow-sm">!</span>
                </a>

                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 border border-slate-200/60 text-sm font-semibold rounded-xl text-slate-700 bg-white hover:bg-slate-50 focus:outline-none transition-all gap-2 shadow-sm">
                                <div class="w-6 h-6 rounded-full bg-slate-900 text-amber-500 flex items-center justify-center text-[10px]">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                {{ Auth::user()->name }}
                                <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('pesanan.index')" class="flex items-center gap-2 py-2.5 text-slate-700">
                                <i class="fa-solid fa-receipt text-slate-400 w-4"></i> Transaksi Saya
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2 py-2.5 text-slate-700">
                                <i class="fa-solid fa-gear text-slate-400 w-4"></i> Pengaturan Akun
                            </x-dropdown-link>
                            <hr class="border-slate-100 my-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-2 py-2.5 text-rose-600 font-medium">
                                    <i class="fa-solid fa-arrow-right-from-bracket text-rose-400 w-4"></i> Keluar
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</nav>
