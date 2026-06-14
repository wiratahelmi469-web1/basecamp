@extends('customer.layouts.app')

@section('content')

<div
    x-data="marketplaceSlider()"
    class="bg-slate-100 min-h-screen pb-20">

    {{-- HERO CAROUSEL --}}
    <section class="max-w-7xl mx-auto px-6 pt-8">

        <div class="relative overflow-hidden rounded-3xl shadow-xl h-[420px]">

            <template x-for="(slide,index) in slides">

                <div
                    x-show="active === index"
                    x-transition
                    class="absolute inset-0">

                    <img
                        :src="slide.image"
                        class="w-full h-full object-cover">

                    <div class="absolute inset-0 bg-black/50"></div>

                    <div class="absolute inset-0 flex items-center">

                        <div class="px-12 text-white">

                            <h1
                                class="text-5xl md:text-6xl font-bold"
                                x-text="slide.title">
                            </h1>

                            <p
                                class="mt-4 text-xl max-w-2xl"
                                x-text="slide.desc">
                            </p>

                            <a
                                href="{{ route('produk.index') }}"
                                class="inline-block mt-6 bg-green-600 hover:bg-green-700 px-8 py-4 rounded-xl">

                                Mulai Sewa

                            </a>

                        </div>

                    </div>

                </div>

            </template>

        </div>

    </section>

    {{-- FLASH SALE --}}
    <section
        x-data="countdown()"
        class="max-w-7xl mx-auto px-6 mt-10">

        <div class="bg-gradient-to-r from-red-600 to-orange-500 text-white rounded-3xl p-8">

            <div class="flex flex-col md:flex-row justify-between items-center">

                <div>

                    <h2 class="text-4xl font-bold">

                        ⚡ FLASH SALE

                    </h2>

                    <p class="mt-2">

                        Harga spesial terbatas hari ini

                    </p>

                </div>

                <div class="text-center mt-6 md:mt-0">

                    <div class="text-5xl font-bold">

                        <span x-text="hours"></span> :

                        <span x-text="minutes"></span> :

                        <span x-text="seconds"></span>

                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- FLASH SALE PRODUCT --}}
    <section class="max-w-7xl mx-auto px-6 py-10">

        <div class="grid md:grid-cols-3 lg:grid-cols-6 gap-6">

            @foreach($flashSale as $produk)

            <a
                href="{{ route('produk.show',$produk->id) }}"
                class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-xl transition hover:-translate-y-1">

                @if($produk->foto)

                <img
                    src="{{ asset('storage/'.$produk->foto) }}"
                    class="w-full h-40 object-cover">

                @endif

                <div class="p-4">

                    <h3 class="font-semibold text-sm">
                        {{ $produk->nama }}
                    </h3>

                    <p class="text-red-600 font-bold mt-2">
                        Rp {{ number_format($produk->harga_sewa_per_hari,0,',','.') }}
                    </p>

                </div>

            </a>

            @endforeach

        </div>

    </section>

    {{-- KATEGORI --}}
    <section class="max-w-7xl mx-auto px-6">

        <h2 class="text-3xl font-bold mb-6">
            Kategori Populer
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">

            @foreach($kategori as $item)

            <a
                href="{{ route('produk.index') }}?kategori={{ $item->id }}"
                class="bg-white rounded-3xl shadow p-6 text-center hover:shadow-lg transition">

                <div class="text-5xl mb-3">

                    @switch(strtolower($item->nama))

                    @case('tenda')
                    ⛺
                    @break

                    @case('carrier')
                    🎒
                    @break

                    @case('sleeping bag')
                    🛏️
                    @break

                    @case('kompor')
                    🔥
                    @break

                    @case('lampu')
                    💡
                    @break

                    @default
                    🏕️

                    @endswitch

                </div>

                <h3 class="font-semibold">
                    {{ $item->nama }}
                </h3>

            </a>

            @endforeach

        </div>

    </section>

    {{-- PRODUK TERBARU --}}
    <section class="max-w-7xl mx-auto px-6 py-12">

        <div class="flex justify-between items-center mb-8">

            <h2 class="text-3xl font-bold">
                Produk Terbaru
            </h2>

            <a
                href="{{ route('produk.index') }}"
                class="text-green-600 font-semibold">

                Lihat Semua →

            </a>

        </div>

        <div class="grid md:grid-cols-4 gap-6">

            @foreach($produkTerbaru as $produk)

            <div class="bg-white rounded-3xl overflow-hidden shadow hover:shadow-xl">

                @if($produk->foto)

                <img
                    src="{{ asset('storage/'.$produk->foto) }}"
                    class="w-full h-60 object-cover">

                @endif

                <div class="p-5">

                    <h3 class="font-semibold">
                        {{ $produk->nama }}
                    </h3>

                    <p class="text-green-600 font-bold mt-2">
                        Rp {{ number_format($produk->harga_sewa_per_hari,0,',','.') }}
                    </p>

                    <a
                        href="{{ route('produk.show',$produk->id) }}"
                        class="block mt-4 text-center bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl">

                        Lihat Detail

                    </a>

                </div>

            </div>

            @endforeach

        </div>

    </section>

    {{-- RIWAYAT --}}
    <section class="max-w-7xl mx-auto px-6">

        <h2 class="text-3xl font-bold mb-6">

            Riwayat Penyewaan

        </h2>

        <div class="bg-white rounded-3xl shadow overflow-hidden">

            @forelse($riwayat as $sewa)

            <div class="p-6 border-b">

                <div class="flex justify-between items-center">

                    <div>

                        <h3 class="font-semibold">
                            {{ $sewa->kode_sewa }}
                        </h3>

                        <p class="text-gray-500">
                            {{ $sewa->tanggal_sewa }}
                        </p>

                    </div>

                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full">

                        {{ ucfirst($sewa->status) }}

                    </span>

                </div>

            </div>

            @empty

            <div class="p-10 text-center text-gray-500">

                Belum ada penyewaan

            </div>

            @endforelse

        </div>

    </section>

</div>

<script>
    function marketplaceSlider() {
        return {

            active: 0,

            slides: [

                {
                    title: 'Jelajahi Alam Tanpa Batas',
                    desc: 'Sewa perlengkapan outdoor premium dengan harga terjangkau.',
                    image: 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b'
                },

                {
                    title: 'Diskon 20% Semua Tenda',
                    desc: 'Promo spesial minggu ini untuk seluruh perlengkapan camping.',
                    image: 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee'
                },

                {
                    title: 'Paket Pendakian Hemat',
                    desc: 'Carrier, sleeping bag dan kompor dalam satu paket.',
                    image: 'https://images.unsplash.com/photo-1522163182402-834f871fd851'
                }

            ],

            init() {
                setInterval(() => {

                    this.active =
                        (this.active + 1) %
                        this.slides.length;

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

                    this.hours =
                        String(
                            Math.floor(diff / 1000 / 60 / 60)
                        ).padStart(2, '0');

                    this.minutes =
                        String(
                            Math.floor(diff / 1000 / 60) % 60
                        ).padStart(2, '0');

                    this.seconds =
                        String(
                            Math.floor(diff / 1000) % 60
                        ).padStart(2, '0');

                }, 1000);
            }
        }
    }
</script>

@endsection
