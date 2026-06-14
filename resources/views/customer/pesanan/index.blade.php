@extends('customer.layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

        <div class="flex justify-between items-center mb-8">

                <div>

                        <h1 class="text-4xl font-bold">
                                Pesanan Saya
                            </h1>

                        <p class="text-gray-500 mt-2">
                                Riwayat penyewaan perlengkapan outdoor
                            </p>

                    </div>

            </div>

        <div class="bg-white rounded-2xl shadow overflow-hidden">

                @forelse($sewas as $sewa)

                    <div class="p-6 border-b">

                            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">

                                    <div>

                                            <h3 class="font-bold text-lg">
                                                    {{ $sewa->kode_sewa }}
                                                </h3>

                                            <p class="text-gray-500">
                                                    Tanggal Sewa:
                                                    {{ \Carbon\Carbon::parse($sewa->tanggal_sewa)->format('d M Y') }}
                                                </p>

                                            <p class="text-gray-500">
                                                    Tanggal Kembali:
                                                    {{ \Carbon\Carbon::parse($sewa->tanggal_kembali)->format('d M Y') }}
                                                </p>

                                        </div>

                                    <div class="text-right">

                                            <p class="font-bold text-green-600 text-xl">
                                                    Rp {{ number_format($sewa->total_harga + $sewa->total_deposit,0,',','.') }}
                                                </p>

                                            <span
                                                    class="inline-block mt-2 px-4 py-2 rounded-full text-sm

                            @if($sewa->status == 'selesai')
                                bg-green-100 text-green-700
                            @elseif($sewa->status == 'dipinjam')
                                bg-blue-100 text-blue-700
                            @elseif($sewa->status == 'menunggu')
                                bg-yellow-100 text-yellow-700
                            @else
                                bg-gray-100 text-gray-700
                            @endif
                        ">

                                                    {{ ucfirst($sewa->status) }}

                                                </span>

                                        </div>

                                </div>

                            <div class="mt-4">

                                    <a
                                            href="{{ route('pesanan.show', $sewa->id) }}"
                                            class="inline-flex items-center px-5 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700">

                                            Lihat Detail

                                        </a>

                                </div>

                        </div>

                @empty

                    <div class="p-12 text-center">

                            <h3 class="text-2xl font-semibold mb-3">
                                    Belum Ada Pesanan
                                </h3>

                            <p class="text-gray-500 mb-6">
                                    Kamu belum pernah melakukan penyewaan.
                                </p>

                            <a
                                    href="{{ route('produk.index') }}"
                                    class="bg-green-600 text-white px-6 py-3 rounded-xl">

                                    Mulai Sewa

                                </a>

                        </div>

                @endforelse

          </div>

</div>

@endsection
