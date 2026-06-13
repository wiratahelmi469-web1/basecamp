@extends('customer.layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-16">

    <div class="grid md:grid-cols-2 gap-12">

        <div>

            @if($produk->foto)

                <img
                    src="{{ asset('storage/' . $produk->foto) }}"
                    class="w-full rounded-3xl shadow">

            @else

                <div class="h-96 bg-gray-200 rounded-3xl"></div>

            @endif

        </div>

        <div>

            <h1 class="text-5xl font-bold">
                {{ $produk->nama }}
            </h1>

            <p class="text-gray-500 mt-4">
                {{ $produk->kategori?->nama }}
            </p>

            <div class="mt-8">

                <span class="text-4xl font-bold text-green-600">

                    Rp {{ number_format($produk->harga_sewa_per_hari,0,',','.') }}

                </span>

                <span class="text-gray-500">
                    / hari
                </span>

            </div>

            <div class="mt-6">

                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full">

                    Stok: {{ $produk->stok }}

                </span>

            </div>

            <div class="mt-10">

                <h3 class="font-bold text-xl mb-3">
                    Deskripsi
                </h3>

                <p class="text-gray-600 leading-relaxed">
                    {{ $produk->deskripsi }}
                </p>

            </div>

            <div class="flex gap-4 mt-10">

                <button
                    class="bg-green-600 text-white px-8 py-4 rounded-xl">

                    Tambah ke Keranjang

                </button>

                <button
                    class="border px-8 py-4 rounded-xl">

                    Sewa Sekarang

                </button>

            </div>

        </div>

    </div>

</div>

@endsection
