@extends('customer.layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-4xl font-bold mb-8">
        Riwayat Pembayaran
    </h1>

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        @forelse($pembayaran as $item)

            <div class="p-6 border-b">

                <div class="flex justify-between items-center">

                    <div>

                        <h3 class="font-semibold text-lg">
                            {{ $item->kode_pembayaran }}
                        </h3>

                        <p class="text-gray-500">
                            {{ $item->metode }}
                        </p>

                        <p class="text-sm text-gray-400">
                            {{ $item->dibayar_pada }}
                        </p>

                    </div>

                    <div class="text-right">

                        <p class="font-bold text-green-600 text-xl">
                            Rp {{ number_format($item->jumlah,0,',','.') }}
                        </p>

                        <span
                            class="inline-block mt-2 px-3 py-1 rounded-full
                            @if($item->status == 'berhasil')
                                bg-green-100 text-green-700
                            @elseif($item->status == 'menunggu')
                                bg-yellow-100 text-yellow-700
                            @else
                                bg-red-100 text-red-700
                            @endif">

                            {{ ucfirst($item->status) }}

                        </span>

                    </div>

                </div>

            </div>

        @empty

            <div class="p-12 text-center text-gray-500">

                Belum ada pembayaran

            </div>

        @endforelse

    </div>

</div>

@endsection
