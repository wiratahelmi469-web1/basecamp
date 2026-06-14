@extends('customer.layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-6 py-10">

    <div class="bg-white rounded-2xl shadow p-8 mb-8">

        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-3xl font-bold">
                    Detail Pesanan
                </h1>

                <p class="text-gray-500 mt-2">
                    Kode Sewa:
                    <strong>{{ $sewa->kode_sewa }}</strong>
                </p>

            </div>

            <div>

                @php
                    $statusColor = match($sewa->status) {
                        'menunggu' => 'bg-yellow-100 text-yellow-700',
                        'dikonfirmasi' => 'bg-blue-100 text-blue-700',
                        'disewa' => 'bg-indigo-100 text-indigo-700',
                        'dikembalikan' => 'bg-purple-100 text-purple-700',
                        'selesai' => 'bg-green-100 text-green-700',
                        'dibatalkan' => 'bg-red-100 text-red-700',
                        default => 'bg-gray-100 text-gray-700',
                    };
                @endphp

                <span class="px-4 py-2 rounded-full {{ $statusColor }}">
                    {{ ucfirst($sewa->status) }}
                </span>

            </div>

        </div>

    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2">

            <div class="bg-white rounded-2xl shadow p-6">

                <h2 class="text-xl font-bold mb-6">
                    Produk Disewa
                </h2>

                @foreach($sewa->detailPenyewaan as $detail)

                    <div class="border-b py-4 last:border-b-0">

                        <div class="flex justify-between">

                            <div>

                                <h3 class="font-semibold text-lg">
                                    {{ $detail->produk->nama }}
                                </h3>

                                <p class="text-gray-500">
                                    Jumlah:
                                    {{ $detail->jumlah }}
                                </p>

                                <p class="text-gray-500">
                                    Durasi:
                                    {{ $detail->jumlah_hari }} Hari
                                </p>

                            </div>

                            <div class="text-right">

                                <p class="font-bold text-green-600">
                                    Rp {{ number_format($detail->subtotal,0,',','.') }}
                                </p>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

        <div>

            <div class="bg-white rounded-2xl shadow p-6 sticky top-24">

                <h2 class="text-xl font-bold mb-6">
                    Ringkasan
                </h2>

                <div class="flex justify-between mb-3">

                    <span>Tanggal Sewa</span>

                    <span>
                        {{ \Carbon\Carbon::parse($sewa->tanggal_sewa)->format('d M Y') }}
                    </span>

                </div>

                <div class="flex justify-between mb-3">

                    <span>Tanggal Kembali</span>

                    <span>
                        {{ \Carbon\Carbon::parse($sewa->tanggal_kembali)->format('d M Y') }}
                    </span>

                </div>

                <hr class="my-4">

                <div class="flex justify-between mb-3">

                    <span>Total Sewa</span>

                    <span>
                        Rp {{ number_format($sewa->total_harga,0,',','.') }}
                    </span>

                </div>

                <div class="flex justify-between mb-3">

                    <span>Total Deposit</span>

                    <span>
                        Rp {{ number_format($sewa->total_deposit,0,',','.') }}
                    </span>

                </div>

                <hr class="my-4">

                <div class="flex justify-between font-bold text-lg">

                    <span>Total Tagihan</span>

                    <span class="text-green-600">
                        Rp {{ number_format($sewa->total_harga + $sewa->total_deposit,0,',','.') }}
                    </span>

                </div>

                @if($sewa->status === 'menunggu')

                    <a
                        href="{{ route('pembayaran.create', $sewa->id) }}"
                        class="block text-center mt-6 bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl">

                        Bayar Sekarang

                    </a>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection
