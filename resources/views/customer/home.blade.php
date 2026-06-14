@extends('customer.layouts.app')

@section('content')

<!-- HERO -->

<section
    class="relative min-h-screen flex items-center bg-cover bg-center"
    style="background-image:url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b');">

```
<div class="absolute inset-0 bg-black/60"></div>

<div class="relative max-w-7xl mx-auto px-6 text-white">

    <span class="uppercase tracking-[4px] text-green-400 text-sm">
        Basecamp Outdoor
    </span>

    <h1 class="text-6xl md:text-8xl font-bold mt-6 leading-tight">
        Jelajahi Alam
        <br>
        Tanpa Batas
    </h1>

    <p class="mt-8 text-xl text-gray-200 max-w-2xl">
        Sewa perlengkapan outdoor premium untuk camping,
        hiking, tracking, dan petualangan alam lainnya.
    </p>

    <div class="flex flex-wrap gap-4 mt-10">

        <a
            href="{{ route('produk.index') }}"
            class="bg-green-600 hover:bg-green-700 px-8 py-4 rounded-xl font-semibold transition">

            Mulai Sewa

        </a>

        <a
            href="/blogs"
            class="border border-white px-8 py-4 rounded-xl hover:bg-white hover:text-black transition">

            Baca Artikel

        </a>

    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-10 mt-20">

        <div>
            <h3 class="text-4xl font-bold">500+</h3>
            <p class="text-gray-300 mt-2">Transaksi</p>
        </div>

        <div>
            <h3 class="text-4xl font-bold">120+</h3>
            <p class="text-gray-300 mt-2">Peralatan</p>
        </div>

        <div>
            <h3 class="text-4xl font-bold">98%</h3>
            <p class="text-gray-300 mt-2">Customer Puas</p>
        </div>

        <div>
            <h3 class="text-4xl font-bold">24/7</h3>
            <p class="text-gray-300 mt-2">Support</p>
        </div>

    </div>

</div>
```

</section>

<!-- KENAPA MEMILIH -->

<section class="py-24 bg-white">

```
<div class="max-w-7xl mx-auto px-6">

    <div class="text-center mb-16">

        <h2 class="text-5xl font-bold">
            Kenapa Memilih Basecamp?
        </h2>

        <p class="text-gray-500 mt-4">
            Solusi penyewaan perlengkapan outdoor yang aman dan terpercaya.
        </p>

    </div>

    <div class="grid md:grid-cols-3 gap-8">

        <div class="bg-gray-50 p-8 rounded-3xl">
            <h3 class="text-2xl font-semibold mb-4">
                Peralatan Terawat
            </h3>

            <p class="text-gray-600">
                Seluruh perlengkapan dicek dan dirawat secara berkala.
            </p>
        </div>

        <div class="bg-gray-50 p-8 rounded-3xl">
            <h3 class="text-2xl font-semibold mb-4">
                Harga Terjangkau
            </h3>

            <p class="text-gray-600">
                Lebih hemat dibanding membeli perlengkapan sendiri.
            </p>
        </div>

        <div class="bg-gray-50 p-8 rounded-3xl">
            <h3 class="text-2xl font-semibold mb-4">
                Booking Cepat
            </h3>

            <p class="text-gray-600">
                Pesan perlengkapan hanya dalam beberapa menit.
            </p>
        </div>

    </div>

</div>
```

</section>

<!-- KATEGORI -->

<section class="py-24 bg-gray-50">

```
<div class="max-w-7xl mx-auto px-6">

    <div class="text-center mb-16">

        <h2 class="text-5xl font-bold">
            Kategori Populer
        </h2>

        <p class="text-gray-500 mt-4">
            Temukan perlengkapan sesuai kebutuhan perjalananmu.
        </p>

    </div>

    <div class="grid md:grid-cols-5 gap-6">

        <div class="bg-white p-8 rounded-3xl text-center shadow">
            <div class="text-5xl mb-4">⛺</div>
            <h3 class="font-semibold">Tenda</h3>
        </div>

        <div class="bg-white p-8 rounded-3xl text-center shadow">
            <div class="text-5xl mb-4">🎒</div>
            <h3 class="font-semibold">Carrier</h3>
        </div>

        <div class="bg-white p-8 rounded-3xl text-center shadow">
            <div class="text-5xl mb-4">🛏️</div>
            <h3 class="font-semibold">Sleeping Bag</h3>
        </div>

        <div class="bg-white p-8 rounded-3xl text-center shadow">
            <div class="text-5xl mb-4">💡</div>
            <h3 class="font-semibold">Lighting</h3>
        </div>

        <div class="bg-white p-8 rounded-3xl text-center shadow">
            <div class="text-5xl mb-4">🔥</div>
            <h3 class="font-semibold">Cooking Set</h3>
        </div>

    </div>

</div>
```

</section>

<!-- PRODUK -->

<section class="py-24 bg-white">

```
<div class="max-w-7xl mx-auto px-6">

    <div class="flex justify-between items-center mb-14">

        <div>

            <h2 class="text-5xl font-bold">
                Produk Unggulan
            </h2>

            <p class="text-gray-500 mt-4">
                Pilihan terbaik untuk petualanganmu.
            </p>

        </div>

        <a
            href="{{ route('produk.index') }}"
            class="text-green-600 font-semibold">

            Lihat Semua →

        </a>

    </div>

    <div class="grid md:grid-cols-4 gap-8">

        @foreach($produks as $produk)

        <div class="bg-white rounded-3xl overflow-hidden shadow hover:shadow-xl transition">

            @if($produk->foto)

            <img
                src="{{ asset('storage/' . $produk->foto) }}"
                class="h-64 w-full object-cover">

            @else

            <div class="h-64 bg-gray-200"></div>

            @endif

            <div class="p-6">

                <h3 class="font-semibold text-xl">
                    {{ $produk->nama }}
                </h3>

                <p class="text-green-600 font-bold mt-3">
                    Rp {{ number_format($produk->harga_sewa_per_hari,0,',','.') }}/hari
                </p>

                <a
                    href="{{ route('produk.show',$produk->id) }}"
                    class="block text-center mt-5 bg-green-600 text-white py-3 rounded-xl">

                    Lihat Detail

                </a>

            </div>

        </div>

        @endforeach

    </div>

</div>
```

</section>

<!-- BLOG -->

@if(isset($posts) && count($posts))

<section class="py-24 bg-gray-50">

```
<div class="max-w-7xl mx-auto px-6">

    <h2 class="text-5xl font-bold mb-14">
        Artikel Terbaru
    </h2>

    <div class="grid md:grid-cols-3 gap-8">

        @foreach($posts as $post)

        <div class="bg-white rounded-3xl shadow overflow-hidden">

            <div class="p-8">

                <h3 class="text-2xl font-semibold mb-4">
                    {{ $post->title }}
                </h3>

                <p class="text-gray-600 mb-6">
                    {{ \Illuminate\Support\Str::limit(strip_tags($post->content),120) }}
                </p>

                <a
                    href="/blogs/{{ $post->slug }}"
                    class="text-green-600 font-semibold">

                    Baca Artikel →

                </a>

            </div>

        </div>

        @endforeach

    </div>

</div>
```

</section>

@endif

<!-- CTA -->

<section class="bg-black text-white py-32">

```
<div class="max-w-4xl mx-auto text-center px-6">

    <h2 class="text-6xl font-bold mb-8">
        Siap Memulai Petualangan?
    </h2>

    <p class="text-gray-300 text-xl mb-10">
        Temukan perlengkapan outdoor terbaik untuk perjalanan berikutnya.
    </p>

    <a
        href="{{ route('produk.index') }}"
        class="bg-green-600 hover:bg-green-700 px-10 py-4 rounded-xl inline-block">

        Lihat Produk

    </a>

</div>
```

</section>

@endsection
