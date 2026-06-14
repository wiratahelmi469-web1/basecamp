@extends('customer.layouts.app')

@section('content')

<div x-data="marketplaceSlider()" class="space-y-12 pb-12">

    {{-- 1. PREMIUM HERO CAROUSEL --}}
    <section class="relative overflow-hidden rounded-3xl shadow-[0_10px_30px_rgba(0,0,0,0.04)] h-[440px] border border-slate-100">
        <div class="absolute bottom-6 left-12 z-30 flex gap-2">
            <template x-for="(slide, index) in slides">
                <button @click="active = index"
                    :class="active === index ? 'w-8 bg-amber-500' : 'w-2 bg-white/40'"
                    class="h-2 rounded-full transition-all duration-300 outline-none"></button>
            </template>
        </div>

        <template x-for="(slide, index) in slides">
            <div x-show="active === index"
                x-transition:enter="transition ease-out duration-700 font-sans"
                x-transition:enter-start="opacity-0 scale-105"
                x-transition:enter-end="opacity-100 scale-100"
                class="absolute inset-0">

                <img :src="slide.image" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950/80 via-slate-900/50 to-transparent"></div>

                <div class="absolute inset-0 flex items-center">
                    <div class="px-8 md:px-12 max-w-2xl space-y-4">
                        <span class="text-xs font-bold uppercase tracking-widest text-amber-500 bg-amber-500/10 px-3 py-1 rounded-md">Basecamp Gear</span>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-none" x-text="slide.title"></h1>
                        <p class="text-slate-300 text-sm md:text-base font-medium max-w-lg" x-text="slide.desc"></p>

                        <div class="pt-2">
                            <a href="{{ route('produk.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold text-sm px-6 py-3.5 rounded-xl transition-all shadow-lg shadow-amber-500/20 hover:-translate-y-0.5">
                                <i class="fa-solid fa-compass text-xs"></i> Mulai Sewa Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </section>


    {{-- 2. ULTRA MODERN FLASH SALE TICKER --}}
    <section x-data="countdown()">
        <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-amber-950 text-white rounded-3xl p-6 md:p-8 border border-slate-800 shadow-xl relative overflow-hidden">
            <div class="absolute right-0 top-0 bottom-0 w-1/3 bg-radial-gradient from-amber-500/10 to-transparent opacity-50 pointer-events-none"></div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-6 relative z-10">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-amber-500 text-slate-950 rounded-xl flex items-center justify-center text-xl shadow-md shadow-amber-500/20 animate-bounce">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <div>
                        <h2 class="text-xl md:text-2xl font-black tracking-tight flex items-center gap-2">FLASH SALE</h2>
                        <p class="text-xs text-slate-400">Penawaran tarif sewa perlengkapan gunung paling murah khusus hari ini.</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 bg-white/5 border border-white/10 p-2.5 rounded-2xl font-mono text-xl md:text-2xl font-bold tracking-wider">
                    <div class="px-3 py-1.5 bg-slate-950/40 rounded-lg text-amber-500" x-text="hours"></div>
                    <span class="text-white/40 animate-pulse">:</span>
                    <div class="px-3 py-1.5 bg-slate-950/40 rounded-lg text-amber-500" x-text="minutes"></div>
                    <span class="text-white/40 animate-pulse">:</span>
                    <div class="px-3 py-1.5 bg-slate-950/40 rounded-lg text-amber-500" x-text="seconds"></div>
                </div>
            </div>
        </div>
    </section>


    {{-- 3. FLASH SALE PRODUCTS GRID --}}
    <section class="space-y-4">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-5">
            @foreach($flashSale as $produk)
            <a href="{{ route('produk.show', $produk->id) }}" class="group bg-white rounded-2xl overflow-hidden border border-slate-200/60 shadow-[0_4px_15px_rgba(0,0,0,0.01)] hover:shadow-[0_12px_25px_rgba(0,0,0,0.04)] hover:border-amber-500/20 transition-all duration-300 hover:-translate-y-1">
                <div class="relative overflow-hidden bg-slate-50 aspect-square">
                    @if($produk->foto)
                    <img src="{{ asset('storage/'.$produk->foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-slate-300"><i class="fa-solid fa-mountain-sun text-xl"></i></div>
                    @endif
                    <span class="absolute top-2.5 left-2.5 text-[9px] font-black uppercase tracking-wider bg-rose-500 text-white px-2 py-0.5 rounded-md shadow-sm">Promo</span>
                </div>

                <div class="p-4 space-y-1.5">
                    <h3 class="font-bold text-slate-800 text-xs md:text-sm truncate group-hover:text-amber-600 transition-colors">{{ $produk->nama }}</h3>
                    <div>
                        <span class="text-[10px] font-semibold text-slate-400 block">Sewa / Hari</span>
                        <p class="text-amber-600 font-extrabold text-sm md:text-base tracking-tight">
                            Rp {{ number_format($produk->harga_sewa_per_hari, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </section>


    {{-- 4. KATEGORI POPULER (ELEGANT ICON BOXES) --}}
    <section class="space-y-5">
        <h2 class="text-lg md:text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
            <span class="w-1.5 h-5 bg-amber-500 rounded-full"></span> Kategori Populer
        </h2>

        <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($kategori as $item)
            <a href="{{ route('produk.index') }}?kategori={{ $item->id }}" class="group bg-white rounded-2xl border border-slate-200/60 p-5 text-center shadow-sm hover:shadow-md hover:border-amber-500/40 transition-all duration-300 flex flex-col items-center gap-3">
                <div class="w-14 h-14 bg-slate-50 text-slate-700 rounded-xl flex items-center justify-center text-xl group-hover:bg-amber-50 group-hover:text-amber-600 shadow-inner transition-colors">
                    @switch(strtolower($item->nama))
                    @case('tenda') <i class="fa-solid fa-campground"></i> @break
                    @case('carrier') <i class="fa-solid fa-backpack"></i> @break
                    @case('sleeping bag') <i class="fa-solid fa-bed"></i> @break
                    @case('kompor') <i class="fa-solid fa-fire-burner"></i> @break
                    @case('lampu') <i class="fa-solid fa-lightbulb"></i> @break
                    @default <i class="fa-solid fa-mountain-sun"></i>
                    @endswitch
                </div>
                <h3 class="font-bold text-slate-800 text-xs tracking-tight group-hover:text-amber-600 transition-colors">{{ $item->nama }}</h3>
            </a>
            @endforeach
        </div>
    </section>


    {{-- 5. PRODUK TERBARU (DELUXE CARDS) --}}
    <section class="space-y-5 pt-4">
        <div class="flex justify-between items-end border-b border-slate-100 pb-3">
            <h2 class="text-lg md:text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                <span class="w-1.5 h-5 bg-amber-500 rounded-full"></span> Koleksi Alat Terbaru
            </h2>
            <a href="{{ route('produk.index') }}" class="text-xs font-bold text-amber-600 hover:text-amber-700 hover:underline flex items-center gap-1">
                Lihat Semua Koleksi <i class="fa-solid fa-chevron-right text-[10px]"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($produkTerbaru as $produk)
            <div class="group bg-white rounded-2xl overflow-hidden border border-slate-200/60 shadow-sm hover:shadow-[0_15px_30px_rgba(0,0,0,0.03)] transition-all duration-300 flex flex-col justify-between">
                <div class="relative bg-slate-50 aspect-[4/3] overflow-hidden">
                    @if($produk->foto)
                    <img src="{{ asset('storage/'.$produk->foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-slate-300"><i class="fa-solid fa-mountain-sun text-2xl"></i></div>
                    @endif
                </div>

                <div class="p-5 space-y-4 flex-1 flex flex-col justify-between">
                    <div class="space-y-1">
                        <h3 class="font-bold text-slate-900 text-sm md:text-base tracking-tight">{{ $produk->nama }}</h3>
                        <p class="text-amber-600 font-extrabold text-base">
                            Rp {{ number_format($produk->harga_sewa_per_hari, 0, ',', '.') }}<span class="text-slate-400 font-medium text-xs">/hari</span>
                        </p>
                    </div>

                    <a href="{{ route('produk.show', $produk->id) }}" class="block w-full text-center bg-slate-900 hover:bg-amber-500 text-white hover:text-slate-950 font-bold text-xs py-3 rounded-xl shadow-sm transition-all duration-300">
                        <i class="fa-solid fa-magnifying-glass mr-1 text-[10px]"></i> Detail Spesifikasi
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>


    {{-- 6. LIVE RENTAL LOG STATUS --}}
    <section class="space-y-4 pt-4">
        <h2 class="text-lg md:text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
            <span class="w-1.5 h-5 bg-amber-500 rounded-full"></span> Aktivitas Sewa Anda
        </h2>

        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden divide-y divide-slate-100">
            @forelse($riwayat as $sewa)
            <div class="p-4 md:p-5 flex justify-between items-center hover:bg-slate-50/40 transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 text-sm">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 text-sm tracking-tight">{{ $sewa->kode_sewa }}</h3>
                        <p class="text-[11px] text-slate-400 font-medium">
                            {{ \Carbon\Carbon::parse($sewa->tanggal_sewa)->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </div>

                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100/80 shadow-sm">
                    <span class="w-1 h-1 rounded-full bg-emerald-500"></span> {{ ucfirst($sewa->status) }}
                </span>
            </div>
            @endforeach
        </div>
    </section>

</div>

@endsection

<script>
    /* JavaScript Alpine.js bawaan Anda dipertahankan penuh tanpa merusak sistem slider/countdown */
    function marketplaceSlider() {
        return {
            active: 0,
            slides: [{
                    title: 'Jelajahi Alam Tanpa Batas',
                    desc: 'Sewa perlengkapan outdoor premium dengan kualitas terbaik dan harga ramah kantong.',
                    image: 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b'
                },
                {
                    title: 'Diskon 20% Semua Tenda',
                    desc: 'Promo spesial minggu ini untuk seluruh perlengkapan camping logistik lengkap.',
                    image: 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee'
                },
                {
                    title: 'Paket Pendakian Hemat',
                    desc: 'Carrier, sleeping bag, dan peralatan masak praktis dalam satu paket praktis.',
                    image: 'https://images.unsplash.com/photo-1522163182402-834f871fd851'
                }
            ],
            init() {
                setInterval(() => {
                    this.active = (this.active + 1) % this.slides.length;
                }, 5000);
            }
        }
    }

    function countdown() {
        return {
            hours: '00',
            minutes: '00',
            seconds: '00',
            init() {
                let end = new Date();
                end.setHours(23, 59, 59);
                setInterval(() => {
                    let now = new Date();
                    let diff = end - now;
                    this.hours = String(Math.floor(diff / 1000 / 60 / 60)).padStart(2, '0');
                    this.minutes = String(Math.floor(diff / 1000 / 60) % 60).padStart(2, '0');
                    this.seconds = String(Math.floor(diff / 1000) % 60).padStart(2, '0');
                }, 1000);
            }
        }
    }
</script>
