<x-app-layout>
    <div class="min-h-screen bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-900">Keranjang Saya</h1>
                <p class="text-slate-500 mt-1">Periksa item sebelum checkout.</p>
            </div>

            @if($items->count())

                <div class="grid lg:grid-cols-3 gap-6">

                    {{-- List Item --}}
                    <div class="lg:col-span-2 space-y-4">

                        @foreach($items as $item)
                            @php
                                $jumlahHari = $item->tanggal_sewa->diffInDays($item->tanggal_kembali);
                                if ($jumlahHari < 1) $jumlahHari = 1;
                                $subtotal = $item->produk->harga_sewa_per_hari * $item->jumlah * $jumlahHari;
                            @endphp

                            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                                <div class="flex items-start justify-between gap-4">

                                    {{-- Kiri --}}
                                    <div class="flex items-start gap-4">
                                        <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                                            <i class="fa-solid fa-box text-amber-500"></i>
                                        </div>
                                        <div>
                                            <h2 class="font-bold text-slate-900 text-base">{{ $item->produk->nama }}</h2>
                                            <p class="text-sm text-slate-500 mt-1">
                                                <i class="fa-regular fa-calendar mr-1"></i>
                                                {{ $item->tanggal_sewa->format('d M Y') }} &rarr; {{ $item->tanggal_kembali->format('d M Y') }}
                                            </p>
                                            <div class="flex gap-4 mt-2 text-sm text-slate-500">
                                                <span><i class="fa-solid fa-cubes mr-1 text-slate-400"></i>{{ $item->jumlah }} unit</span>
                                                <span><i class="fa-solid fa-clock mr-1 text-slate-400"></i>{{ $jumlahHari }} hari</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Kanan: Harga --}}
                                    <div class="shrink-0 text-right">
                                        <p class="font-bold text-slate-900 text-lg">
                                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                                        </p>
                                        <p class="text-xs text-slate-400 mt-0.5">
                                            Rp {{ number_format($item->produk->harga_sewa_per_hari, 0, ',', '.') }}/hari
                                        </p>
                                    </div>

                                </div>
                            </div>

                        @endforeach

                    </div>

                    {{-- Ringkasan --}}
                    <div>
                        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sticky top-24">
                            <h3 class="font-bold text-slate-900 text-lg mb-5">Ringkasan Pesanan</h3>

                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Total Sewa</span>
                                    <span class="font-medium text-slate-900">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Total Deposit</span>
                                    <span class="font-medium text-slate-900">Rp {{ number_format($totalDeposit, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <hr class="my-4 border-slate-100">

                            <div class="flex justify-between items-center mb-6">
                                <span class="font-bold text-slate-900">Total Tagihan</span>
                                <span class="font-bold text-lg text-slate-900">
                                    Rp {{ number_format($totalHarga + $totalDeposit, 0, ',', '.') }}
                                </span>
                            </div>

                            <form action="{{ route('checkout.store') }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="w-full bg-amber-500 hover:bg-amber-600 text-white font-semibold py-3 rounded-xl transition-colors duration-150 shadow-[0_4px_14px_rgba(245,158,11,0.3)]">
                                    <i class="fa-solid fa-credit-card mr-2"></i>
                                    Checkout
                                </button>
                            </form>

                        </div>
                    </div>

                </div>

            @else

                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-16 text-center">
                    <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-cart-shopping text-slate-400 text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 mb-2">Keranjang Masih Kosong</h2>
                    <p class="text-slate-500 mb-6">Belum ada produk yang ditambahkan ke keranjang.</p>
                    <a href="{{ route('produk.index') }}"
                       class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-xl transition-colors duration-150">
                        <i class="fa-solid fa-tent"></i>
                        Cari Produk
                    </a>
                </div>

            @endif

        </div>
    </div>
</x-app-layout>
