@extends('customer.layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-4xl font-bold mb-8">
        Keranjang Saya
    </h1>

    @if($items->count())

        <div class="grid lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2">

                @foreach($items as $item)

                    @php

                        $jumlahHari =
                            $item->tanggal_sewa
                                ->diffInDays($item->tanggal_kembali);

                        if ($jumlahHari < 1) {
                            $jumlahHari = 1;
                        }

                        $subtotal =
                            $item->produk->harga_sewa_per_hari *
                            $item->jumlah *
                            $jumlahHari;

                    @endphp

                    <div class="bg-white rounded-2xl shadow p-6 mb-5">

                        <div class="flex justify-between">

                            <div>

                                <h2 class="font-bold text-xl">
                                    {{ $item->produk->nama }}
                                </h2>

                                <p class="text-gray-500 mt-2">
                                    {{ $item->tanggal_sewa->format('d M Y') }}
                                    -
                                    {{ $item->tanggal_kembali->format('d M Y') }}
                                </p>

                                <p class="mt-2">
                                    Jumlah:
                                    {{ $item->jumlah }}
                                </p>

                                <p>
                                    Durasi:
                                    {{ $jumlahHari }} Hari
                                </p>

                            </div>

                            <div class="text-right">

                                <p class="font-bold text-green-600 text-xl">
                                    Rp {{ number_format($subtotal,0,',','.') }}
                                </p>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            <div>

                <div class="bg-white rounded-2xl shadow p-6 sticky top-24">

                    <h3 class="font-bold text-xl mb-6">
                        Ringkasan Pesanan
                    </h3>

                    <div class="flex justify-between mb-4">

                        <span>Total Sewa</span>

                        <span>
                            Rp {{ number_format($totalHarga,0,',','.') }}
                        </span>

                    </div>

                    <div class="flex justify-between mb-6">

                        <span>Total Deposit</span>

                        <span>
                            Rp {{ number_format($totalDeposit,0,',','.') }}
                        </span>

                    </div>

                    <hr>

                    <div class="flex justify-between mt-6 font-bold text-lg">

                        <span>Total</span>

                        <span>
                            Rp {{ number_format($totalHarga + $totalDeposit,0,',','.') }}
                        </span>

                    </div>

                    <a
                        href="#"
                        class="block mt-6 text-center bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl">

                        Checkout

                    </a>

                </div>

            </div>

        </div>

    @else

        <div class="bg-white rounded-2xl shadow p-12 text-center">

            <h2 class="text-2xl font-semibold">
                Keranjang masih kosong
            </h2>

            <a
                href="{{ route('produk.index') }}"
                class="inline-block mt-6 bg-green-600 text-white px-6 py-3 rounded-xl">

                Cari Produk

            </a>

        </div>

    @endif

</div>

@endsection
