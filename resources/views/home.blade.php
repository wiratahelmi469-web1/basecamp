<x-app-layout>
    {{-- ===================== HERO SLIDER ===================== --}}
    <div class="relative -mx-6 md:-mx-10 -mt-10 mb-10 overflow-hidden rounded-2xl" style="margin-top: -2.5rem;">
        <div x-data="{
            current: 0,
            slides: [
                {
                    tag: 'BASECAMP GEAR',
                    title: 'Paket Pendakian Hemat',
                    desc: 'Carrier, sleeping bag, dan peralatan masak praktis dalam satu paket praktis.',
                    bg: 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=1400&q=80'
                },
                {
                    tag: 'OUTDOOR READY',
                    title: 'Tenda Premium Siap Pakai',
                    desc: 'Tenda berkualitas tinggi, bersih, dan terawat untuk petualangan terbaik kamu.',
                    bg: 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=1400&q=80'
                },
                {
                    tag: 'BASECAMP OUTDOOR',
                    title: 'Sewa, Jelajah, Kembali',
                    desc: 'Semua perlengkapan outdoor tersedia. Tanpa harus beli, cukup sewa dan berangkat.',
                    bg: 'https://images.unsplash.com/photo-1501854140801-50d01698950b?w=1400&q=80'
                }
            ],
            autoplay: null,
            start() {
                this.autoplay = setInterval(() => {
                    this.current = (this.current + 1) % this.slides.length
                }, 4000)
            }
        }" x-init="start()" class="relative h-[420px] md:h-[520px]">

            {{-- Slides --}}
            <template x-for="(slide, i) in slides" :key="i">
                <div x-show="current === i"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="absolute inset-0 rounded-2xl overflow-hidden">
                    <img :src="slide.bg" class="w-full h-full object-cover" :alt="slide.title">
                    <div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 via-slate-900/50 to-transparent rounded-2xl"></div>
                    <div class="absolute inset-0 flex flex-col justify-center px-8 md:px-14">
                        <span class="inline-block text-[11px] font-bold tracking-widest text-amber-400 bg-amber-500/20 border border-amber-500/30 px-3 py-1 rounded-full w-max mb-4"
                            x-text="slide.tag"></span>
                        <h1 class="text-3xl md:text-5xl font-extrabold text-white leading-tight max-w-xl tracking-tight"
                            x-text="slide.title"></h1>
                        <p class="text-sm md:text-base text-slate-300 mt-3 max-w-sm leading-relaxed"
                            x-text="slide.desc"></p>
                        <div class="mt-6">
                            <a href="{{ route('produk.index') }}"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold rounded-xl transition-all duration-200 shadow-lg shadow-amber-900/30">
                                <i class="fa-solid fa-store text-xs"></i> Mulai Sewa Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </template>

            {{-- Dots --}}
            <div class="absolute bottom-5 left-8 md:left-14 flex items-center gap-2">
                <template x-for="(slide, i) in slides" :key="i">
                    <button @click="current = i; clearInterval(autoplay); start()"
                        class="transition-all duration-300 rounded-full"
                        :class="current === i ? 'w-8 h-2 bg-amber-400' : 'w-2 h-2 bg-white/40 hover:bg-white/70'">
                    </button>
                </template>
            </div>
        </div>
    </div>

    {{-- ===================== STATS ===================== --}}
    <div class="grid grid-cols-3 gap-4 mb-10">
        @php
        $stats = [
        ['value' => $totalProduk, 'label' => 'Produk Outdoor', 'icon' => 'fa-box-open'],
        ['value' => $totalPenyewaan, 'label' => 'Total Penyewaan', 'icon' => 'fa-receipt'],
        ['value' => $totalCustomer, 'label' => 'Customer Aktif', 'icon' => 'fa-users'],
        ];
        @endphp
        @foreach ($stats as $stat)
        <div class="bg-slate-900 rounded-2xl px-5 py-6 text-center">
            <i class="fa-solid {{ $stat['icon'] }} text-amber-400 text-xl mb-2 block"></i>
            <div class="text-3xl font-extrabold text-white tracking-tight">{{ $stat['value'] }}+</div>
            <div class="text-xs text-slate-400 mt-1 font-medium">{{ $stat['label'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- ===================== KATEGORI ===================== --}}
    <div class="mb-12">
        <div class="flex items-end justify-between mb-6">
            <div>
                <span class="text-xs font-bold tracking-widest text-amber-500 uppercase">Jelajahi</span>
                <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight mt-0.5">Kategori Outdoor</h2>
            </div>
            <a href="{{ route('produk.index') }}" class="text-sm font-semibold text-amber-500 hover:text-amber-600 flex items-center gap-1 transition-colors">
                Lihat Semua <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @php
            $icons = ['fa-tent', 'fa-person-hiking', 'fa-utensils', 'fa-compass', 'fa-fire', 'fa-backpack', 'fa-snowflake', 'fa-mountain'];
            @endphp
            @foreach ($kategori as $i => $item)
            <a href="{{ route('produk.index', ['kategori' => $item->id]) }}"
                class="group bg-white rounded-2xl border border-slate-200/80 p-5 text-center hover:border-amber-300 hover:shadow-md hover:shadow-amber-100 transition-all duration-200">
                <div class="w-12 h-12 bg-amber-50 group-hover:bg-amber-100 rounded-xl flex items-center justify-center mx-auto mb-3 transition-colors">
                    <i class="fa-solid {{ $icons[$i % count($icons)] }} text-amber-500 text-lg"></i>
                </div>
                <h4 class="text-sm font-bold text-slate-800 leading-tight">{{ $item->nama }}</h4>
                <p class="text-xs text-slate-400 mt-1">{{ $item->produk_count }} Produk</p>
            </a>
            @endforeach
        </div>
    </div>

    {{-- ===================== PRODUK TERBARU ===================== --}}
    <div class="mb-12">
        <div class="flex items-end justify-between mb-6">
            <div>
                <span class="text-xs font-bold tracking-widest text-amber-500 uppercase">Tersedia</span>
                <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight mt-0.5">Produk Terbaru</h2>
            </div>
            <a href="{{ route('produk.index') }}" class="text-sm font-semibold text-amber-500 hover:text-amber-600 flex items-center gap-1 transition-colors">
                Semua Produk <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($produkTerbaru as $produk)
            <a href="{{ route('produk.show', $produk->slug ?? $produk->id) }}"
                class="group bg-white rounded-2xl border border-slate-200/80 overflow-hidden hover:shadow-lg hover:shadow-slate-200/60 hover:-translate-y-1 transition-all duration-200">
                <div class="aspect-[4/3] overflow-hidden bg-slate-100">
                    @if ($produk->foto)
                    <img src="{{ asset('storage/' . $produk->foto) }}"
                        alt="{{ $produk->nama }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fa-solid fa-image text-slate-300 text-4xl"></i>
                    </div>
                    @endif
                </div>
                <div class="p-4">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">{{ $produk->merek }}</span>
                    <h4 class="font-bold text-slate-900 mt-0.5 leading-tight text-[15px]">{{ $produk->nama }}</h4>
                    <div class="flex items-center justify-between mt-3">
                        <div>
                            <span class="text-amber-600 font-extrabold text-base">
                                Rp {{ number_format($produk->harga_sewa_per_hari, 0, ',', '.') }}
                            </span>
                            <span class="text-xs text-slate-400">/hari</span>
                        </div>
                        <span class="text-[11px] font-semibold px-2.5 py-1 rounded-full
                                {{ $produk->stok > 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-500' }}">
                            {{ $produk->stok > 0 ? 'Tersedia' : 'Habis' }}
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    {{-- ===================== KENAPA KAMI ===================== --}}
    <div class="mb-12 bg-slate-900 rounded-2xl p-8 md:p-10">
        <div class="text-center mb-8">
            <span class="text-xs font-bold tracking-widest text-amber-400 uppercase">Keunggulan</span>
            <h2 class="text-2xl font-extrabold text-white tracking-tight mt-1">Kenapa Memilih Kami?</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
            $features = [
            ['icon' => 'fa-box-open', 'title' => 'Peralatan Lengkap', 'desc' => 'Ratusan pilihan alat outdoor terbaik'],
            ['icon' => 'fa-star', 'title' => 'Bersih & Terawat', 'desc' => 'Dicek dan dibersihkan setiap kali kembali'],
            ['icon' => 'fa-bolt', 'title' => 'Proses Cepat', 'desc' => 'Booking mudah, konfirmasi instan'],
            ['icon' => 'fa-tag', 'title' => 'Harga Terjangkau', 'desc' => 'Mulai dari puluhan ribu per hari'],
            ];
            @endphp
            @foreach ($features as $f)
            <div class="bg-slate-800/60 rounded-xl p-5 text-center border border-slate-700/50">
                <div class="w-11 h-11 bg-amber-500/15 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fa-solid {{ $f['icon'] }} text-amber-400 text-lg"></i>
                </div>
                <h5 class="font-bold text-white text-sm leading-tight">{{ $f['title'] }}</h5>
                <p class="text-xs text-slate-400 mt-1.5 leading-relaxed">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- ===================== ARTIKEL TERBARU ===================== --}}
    @if(isset($artikelTerbaru) && $artikelTerbaru->count())
    <div class="mb-10">
        <div class="flex items-end justify-between mb-6">
            <div>
                <span class="text-xs font-bold tracking-widest text-amber-500 uppercase">Edu-Blog</span>
                <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight mt-0.5">Artikel Terbaru</h2>
            </div>
            <a href="{{ route('filamentblog.post.index') }}" class="text-sm font-semibold text-amber-500 hover:text-amber-600 flex items-center gap-1 transition-colors">
                Semua Artikel <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($artikelTerbaru as $artikel)
            <a href="{{ route('filamentblog.post.show', $artikel->slug) }}"
                class="group bg-white rounded-2xl border border-slate-200/80 overflow-hidden hover:shadow-lg hover:shadow-slate-200/60 hover:-translate-y-1 transition-all duration-200">
                @if ($artikel->thumbnail)
                <div class="aspect-[16/9] overflow-hidden bg-slate-100">
                    <img src="{{ asset('storage/' . $artikel->thumbnail) }}"
                        alt="{{ $artikel->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                @endif
                <div class="p-4">
                    <h5 class="font-bold text-slate-900 text-[15px] leading-snug line-clamp-2">{{ $artikel->title }}</h5>
                    <p class="text-xs text-slate-400 mt-2 line-clamp-2 leading-relaxed">{{ $artikel->excerpt }}</p>
                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-amber-500 mt-3">
                        Baca Selengkapnya <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ===================== CTA ===================== --}}
    <div class="rounded-2xl overflow-hidden relative mb-4">
        <div class="absolute inset-0 bg-slate-900"></div>
        <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="relative z-10 py-12 px-8 md:px-14 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Siap Memulai Petualangan?</h2>
                <p class="text-slate-400 mt-2 text-sm max-w-md">Sewa perlengkapan outdoor terbaik tanpa harus membeli. Proses mudah, harga terjangkau.</p>
            </div>
            <a href="{{ route('produk.index') }}"
                class="shrink-0 inline-flex items-center gap-2 px-7 py-3.5 bg-amber-500 hover:bg-amber-600 text-white font-bold text-sm rounded-xl transition-all duration-200 shadow-lg shadow-amber-900/30 whitespace-nowrap">
                <i class="fa-solid fa-store text-xs"></i> Jelajahi Katalog
            </a>
        </div>
    </div>
</x-app-layout>
