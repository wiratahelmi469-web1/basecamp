<x-app-layout>

    {{-- HERO --}}
    <section class="relative min-h-screen flex items-center bg-cover bg-center -mx-6 -mt-6 md:-mx-10 md:-mt-10 rounded-t-3xl overflow-hidden"
        style="background-image:url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b');">

        <div class="absolute inset-0 bg-gradient-to-br from-slate-900/80 via-slate-900/60 to-slate-800/40"></div>

        <div class="relative max-w-7xl mx-auto px-6 py-32 w-full">

            <span class="uppercase tracking-[4px] text-amber-400 text-xs font-bold">
                Basecamp Outdoor
            </span>

            <h1 class="text-5xl md:text-7xl font-extrabold mt-6 leading-tight text-white">
                Jelajahi Alam<br>Tanpa Batas
            </h1>

            <p class="mt-6 text-lg text-slate-300 max-w-2xl leading-relaxed">
                Sewa perlengkapan outdoor premium untuk camping, hiking, tracking, dan petualangan alam lainnya.
            </p>

            <div class="flex flex-wrap gap-4 mt-10">
                <a href="{{ route('produk.index') }}"
                    class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold px-8 py-4 rounded-xl transition-colors duration-150 shadow-[0_4px_14px_rgba(245,158,11,0.4)]">
                    <i class="fa-solid fa-tent"></i>
                    Mulai Sewa
                </a>
                <a href="/blogs"
                    class="inline-flex items-center gap-2 border border-white/30 bg-white/10 backdrop-blur-sm text-white font-semibold px-8 py-4 rounded-xl hover:bg-white/20 transition-colors duration-150">
                    <i class="fa-solid fa-book-open"></i>
                    Baca Artikel
                </a>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-20 pt-10 border-t border-white/10">
                <div>
                    <h3 class="text-4xl font-extrabold text-white">500+</h3>
                    <p class="text-slate-400 mt-1 text-sm">Transaksi</p>
                </div>
                <div>
                    <h3 class="text-4xl font-extrabold text-white">120+</h3>
                    <p class="text-slate-400 mt-1 text-sm">Peralatan</p>
                </div>
                <div>
                    <h3 class="text-4xl font-extrabold text-white">98%</h3>
                    <p class="text-slate-400 mt-1 text-sm">Customer Puas</p>
                </div>
                <div>
                    <h3 class="text-4xl font-extrabold text-white">24/7</h3>
                    <p class="text-slate-400 mt-1 text-sm">Support</p>
                </div>
            </div>

        </div>
    </section>

    {{-- KENAPA MEMILIH --}}
    <section class="py-24 -mx-6 md:-mx-10 px-6 md:px-10 bg-white">
        <div class="max-w-7xl mx-auto">

            <div class="text-center mb-14">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-500">Keunggulan Kami</span>
                <h2 class="text-4xl font-extrabold text-slate-900 mt-3">Kenapa Memilih Basecamp?</h2>
                <p class="text-slate-500 mt-3 max-w-xl mx-auto">Solusi penyewaan perlengkapan outdoor yang aman dan terpercaya.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-slate-50 border border-slate-100 p-8 rounded-2xl hover:shadow-md transition-shadow duration-200">
                    <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center mb-5">
                        <i class="fa-solid fa-shield-halved text-amber-500 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Peralatan Terawat</h3>
                    <p class="text-slate-500 leading-relaxed">Seluruh perlengkapan dicek dan dirawat secara berkala untuk keamananmu.</p>
                </div>
                <div class="bg-slate-50 border border-slate-100 p-8 rounded-2xl hover:shadow-md transition-shadow duration-200">
                    <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center mb-5">
                        <i class="fa-solid fa-tag text-amber-500 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Harga Terjangkau</h3>
                    <p class="text-slate-500 leading-relaxed">Lebih hemat dibanding membeli perlengkapan sendiri, tanpa kompromi kualitas.</p>
                </div>
                <div class="bg-slate-50 border border-slate-100 p-8 rounded-2xl hover:shadow-md transition-shadow duration-200">
                    <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center mb-5">
                        <i class="fa-solid fa-bolt text-amber-500 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Booking Cepat</h3>
                    <p class="text-slate-500 leading-relaxed">Pesan perlengkapan hanya dalam beberapa menit, langsung dari HP-mu.</p>
                </div>
            </div>

        </div>
    </section>

    {{-- KATEGORI --}}
    <section class="py-24 -mx-6 md:-mx-10 px-6 md:px-10 bg-slate-50">
        <div class="max-w-7xl mx-auto">

            <div class="text-center mb-14">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-500">Kategori</span>
                <h2 class="text-4xl font-extrabold text-slate-900 mt-3">Kategori Populer</h2>
                <p class="text-slate-500 mt-3">Temukan perlengkapan sesuai kebutuhan perjalananmu.</p>
            </div>

            <div class="grid grid-cols-3 md:grid-cols-5 gap-4">
                @foreach([
                ['icon' => 'fa-campground', 'label' => 'Tenda'],
                ['icon' => 'fa-person-hiking', 'label' => 'Carrier'],
                ['icon' => 'fa-bed', 'label' => 'Sleeping Bag'],
                ['icon' => 'fa-lightbulb', 'label' => 'Lighting'],
                ['icon' => 'fa-fire-burner', 'label' => 'Cooking Set'],
                ] as $kat)
                <div class="bg-white border border-slate-100 p-6 rounded-2xl text-center shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 cursor-pointer">
                    <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fa-solid {{ $kat['icon'] }} text-amber-500 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-slate-900 text-sm">{{ $kat['label'] }}</h3>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- PRODUK UNGGULAN --}}
    <section class="py-24 -mx-6 md:-mx-10 px-6 md:px-10 bg-white">
        <div class="max-w-7xl mx-auto">

            <div class="flex justify-between items-end mb-12">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-500">Pilihan Terbaik</span>
                    <h2 class="text-4xl font-extrabold text-slate-900 mt-3">Produk Unggulan</h2>
                    <p class="text-slate-500 mt-2">Pilihan terbaik untuk petualanganmu.</p>
                </div>
                <a href="{{ route('produk.index') }}"
                    class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-700 hover:text-amber-500 transition-colors">
                    Lihat Semua <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                @foreach($produks as $produk)
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 overflow-hidden group">
                    <div class="relative h-48 overflow-hidden">
                        @if($produk->foto)
                        <img src="{{ asset('storage/' . $produk->foto) }}"
                            alt="{{ $produk->nama }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                        <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                            <i class="fa-solid fa-image text-slate-300 text-3xl"></i>
                        </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-slate-900 text-sm line-clamp-2">{{ $produk->nama }}</h3>
                        <p class="font-bold text-slate-900 text-base mt-2">
                            Rp {{ number_format($produk->harga_sewa_per_hari, 0, ',', '.') }}
                            <span class="text-xs font-normal text-slate-400">/hari</span>
                        </p>
                        <a href="{{ route('produk.show', $produk->id) }}"
                            class="block text-center mt-4 bg-slate-900 hover:bg-amber-500 text-white text-sm font-semibold py-2.5 rounded-xl transition-colors duration-150">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ARTIKEL TERBARU --}}
    @if(isset($posts) && count($posts))
    <section class="py-24 -mx-6 md:-mx-10 px-6 md:px-10 bg-slate-50">
        <div class="max-w-7xl mx-auto">

            <div class="flex justify-between items-end mb-12">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-500">Blog</span>
                    <h2 class="text-4xl font-extrabold text-slate-900 mt-3">Artikel Terbaru</h2>
                </div>
                <a href="/blogs"
                    class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-700 hover:text-amber-500 transition-colors">
                    Lihat Semua <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach($posts as $post)
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-slate-900 line-clamp-2">{{ $post->title }}</h3>
                        <p class="text-slate-500 text-sm mt-3 leading-relaxed line-clamp-3">
                            {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}
                        </p>
                        <a href="/blogs/{{ $post->slug }}"
                            class="inline-flex items-center gap-1.5 text-sm font-semibold text-amber-500 hover:text-amber-600 mt-5 transition-colors">
                            Baca Artikel <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>
    @endif

    {{-- CTA --}}
    <section class="py-24 -mx-6 md:-mx-10 px-6 md:px-10 -mb-6 md:-mb-10 rounded-b-3xl overflow-hidden bg-slate-900 relative">
        <div class="absolute top-0 right-0 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-3xl mx-auto text-center relative z-10">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-400">Ayo Mulai</span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-white mt-4 mb-6 leading-tight">
                Siap Memulai<br>Petualangan?
            </h2>
            <p class="text-slate-400 text-lg mb-10">
                Temukan perlengkapan outdoor terbaik untuk perjalanan berikutnya.
            </p>
            <a href="{{ route('produk.index') }}"
                class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold px-10 py-4 rounded-xl transition-colors duration-150 shadow-[0_4px_20px_rgba(245,158,11,0.4)]">
                <i class="fa-solid fa-tent"></i>
                Lihat Produk
            </a>
        </div>
    </section>

</x-app-layout>
