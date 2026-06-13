@extends('customer.layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-16">

    <div class="mb-10">

        <h1 class="text-5xl font-bold">
            Katalog Produk
        </h1>

        <p class="text-gray-500 mt-3">
            Pilih perlengkapan outdoor terbaik untuk petualanganmu.
        </p>

    </div>

    <div class="grid md:grid-cols-4 gap-8">

        @foreach($produks as $produk)

            <div class="bg-white rounded-3xl shadow hover:shadow-xl transition overflow-hidden">

                @if($produk->foto)

                    <img
                        src="{{ asset('storage/' . $produk->foto) }}"
                        class="h-64 w-full object-cover">

                @else

                    <div class="h-64 bg-gray-200 flex items-center justify-center">
                        Tidak Ada Foto
                    </div>

                @endif

                <div class="p-5">

                    <h3 class="font-semibold text-lg">
                        {{ $produk->nama }}
                    </h3>

                    <p class="text-gray-500 mt-1">
                        {{ $produk->kategori?->nama }}
                    </p>

                    <p class="text-green-600 font-bold text-xl mt-4">
                        Rp {{ number_format($produk->harga_sewa_per_hari,0,',','.') }}/hari
                    </p>

                    <a
                        href="{{ route('produk.show',$produk->id) }}"
                        class="block text-center mt-5 bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl">

                        Lihat Detail

                    </a>

                </div>

            </div>

        @endforeach

    </div>

    <div class="mt-10">

        {{ $produks->links() }}

    </div>

</div>

@endsection
