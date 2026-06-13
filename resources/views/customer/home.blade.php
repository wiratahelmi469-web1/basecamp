@extends('customer.layouts.app')

@section('content')

{{-- HERO SECTION --}}
<section
    class="relative h-screen flex items-center bg-cover bg-center"
    style="background-image: url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b');">

    <div class="absolute inset-0 bg-black/50"></div>

    <div class="relative max-w-7xl mx-auto px-6 text-white">

        <span class="uppercase tracking-widest text-sm text-green-300">
            Basecamp Outdoor
        </span>

        <h1 class="text-6xl md:text-8xl font-bold leading-tight mt-4">
            Jelajahi Alam
            <br>
            Tanpa Batas
        </h1>

        <p class="mt-6 text-xl max-w-2xl text-gray-200">
            Sewa perlengkapan outdoor berkualitas untuk camping,
            hiking, tracking, dan petualangan alam lainnya.
        </p>

        <div class="mt-8 flex gap-4">

            <a
                href="{{ route('produk.index') }}"
                class="bg-green-600 hover:bg-green-700 px-8 py-4 rounded-xl font-semibold transition">
                Mulai Sewa
            </a>

            <a
                href="#produk"
                class="border border-white px-8 py-4 rounded-xl hover:bg-white hover:text-black transition">
                Lihat Produk
            </a>

        </div>

    </div>

</section>

{{-- KATEGORI --}}
<section class="max-w-7xl mx-auto px-6 py-24">

    <div class="text-center mb-14">

        <h2 class="text-5xl font-bold">
            Kategori Populer
        </h2>

        <p class="text-gray-500 mt-4">
            Pilih perlengkapan sesuai kebutuhan petualanganmu
        </p>

    </div>

    <div class="grid md:grid-cols-5 gap-6">

        <div class="bg-white rounded-3xl shadow p-8 text-center">
            <div class="text-5xl mb-4">⛺</div>
            <h3 class="font-semibold">Tenda</h3>
        </div>

        <div class="bg-white rounded-3xl shadow p-8 text-center">
            <div class="text-5xl mb-4">🎒</div>
            <h3 class="font-semibold">Carrier</h3>
        </div>

        <div class="bg-white rounded-3xl shadow p-8 text-center">
            <div class="text-5xl mb-4">🛏️</div>
            <h3 class="font-semibold">Sleeping Bag</h3>
        </div>

        <div class="bg-white rounded-3xl shadow p-8 text-center">
            <div class="text-5xl mb-4">💡</div>
            <h3 class="font-semibold">Penerangan</h3>
        </div>

        <div class="bg-white rounded-3xl shadow p-8 text-center">
            <div class="text-5xl mb-4">🔥</div>
            <h3 class="font-semibold">Memasak</h3>
        </div>

    </div>

</section>

{{-- PRODUK UNGGULAN --}}
<section
    id="produk"
    class="bg-gray-50 py-24">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center mb-12">

            <div>

                <h2 class="text-5xl font-bold">
                    Produk Unggulan
                </h2>

                <p class="text-gray-500 mt-3">
                    Peralatan outdoor terbaik untuk petualanganmu
                </p>

            </div>

            <a
                href="{{ route('produk.index') }}"
                class="text-green-600 font-semibold">
                Lihat Semua →
            </a>

        </div>

        <div class="grid md:grid-cols-3 gap-8">

            @foreach($produks as $produk)

                <div class="bg-white rounded-3xl overflow-hidden shadow hover:shadow-xl transition">

                    @if($produk->foto)

                        <img
                            src="{{ asset('storage/' . $produk->foto) }}"
                            class="w-full h-72 object-cover"
                            alt="{{ $produk->nama }}">

                    @else

                        <div class="h-72 bg-gray-200 flex items-center justify-center">

                            <span class="text-gray-500">
                                Tidak Ada Foto
                            </span>

                        </div>

                    @endif

                    <div class="p-6">

                        <h3 class="text-xl font-semibold">
                            {{ $produk->nama }}
                        </h3>

                        <p class="text-green-600 font-bold text-xl mt-3">
                            Rp {{ number_format($produk->harga_sewa_per_hari, 0, ',', '.') }}/hari
                        </p>

                        <a
                            href="{{ route('produk.show', $produk->id) }}"
                            class="block text-center mt-5 bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl transition">

                            Lihat Detail

                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>

{{-- TENTANG --}}
<section class="max-w-7xl mx-auto px-6 py-24">

    <div class="grid md:grid-cols-2 gap-12 items-center">

        <div>

            <h2 class="text-5xl font-bold mb-6">
                Kenapa Memilih Basecamp?
            </h2>

            <p class="text-gray-600 text-lg">
                Kami menyediakan perlengkapan outdoor berkualitas,
                terawat, dan siap digunakan untuk berbagai kegiatan
                camping, hiking, dan pendakian.
            </p>

        </div>

        <div class="grid gap-6">

            <div class="bg-white shadow rounded-2xl p-6">
                ✓ Peralatan Terawat
            </div>

            <div class="bg-white shadow rounded-2xl p-6">
                ✓ Harga Terjangkau
            </div>

            <div class="bg-white shadow rounded-2xl p-6">
                ✓ Booking Online Mudah
            </div>

            <div class="bg-white shadow rounded-2xl p-6">
                ✓ Customer Support Cepat
            </div>

        </div>

    </div>

</section>

{{-- BLOG --}}
@if(isset($posts) && count($posts))

<section class="bg-gray-50 py-24">

    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-5xl font-bold mb-12">
            Artikel Outdoor
        </h2>

        <div class="grid md:grid-cols-3 gap-8">

            @foreach($posts as $post)

                <div class="bg-white rounded-3xl shadow p-6">

                    <h3 class="text-xl font-semibold mb-3">
                        {{ $post->title }}
                    </h3>

                    <p class="text-gray-600">
                        {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}
                    </p>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endif

@endsection
