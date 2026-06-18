<x-app-layout>
    <div class="min-h-screen bg-slate-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- Header --}}
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <a href="{{ route('pesanan.index') }}"
                        class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-slate-900 mb-3 transition-colors">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        Kembali ke Pesanan
                    </a>
                    <h1 class="text-3xl font-bold text-slate-900">Detail Pesanan</h1>
                    <p class="text-slate-500 mt-1">Kode Sewa: <span class="font-semibold text-slate-700">{{ $sewa->kode_sewa }}</span></p>
                </div>

                @php
                $statusConfig = match($sewa->status) {
                'menunggu' => ['bg-amber-50 text-amber-700', 'bg-amber-500'],
                'dikonfirmasi' => ['bg-blue-50 text-blue-700', 'bg-blue-500'],
                'disewa','dipinjam' => ['bg-indigo-50 text-indigo-700', 'bg-indigo-500'],
                'dikembalikan' => ['bg-purple-50 text-purple-700', 'bg-purple-500'],
                'selesai' => ['bg-emerald-50 text-emerald-700', 'bg-emerald-500'],
                'dibatalkan' => ['bg-red-50 text-red-700', 'bg-red-500'],
                default => ['bg-slate-100 text-slate-600', 'bg-slate-400'],
                };
                @endphp
                <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold {{ $statusConfig[0] }}">
                    <span class="w-2 h-2 rounded-full {{ $statusConfig[1] }}"></span>
                    {{ ucfirst($sewa->status) }}
                </span>
            </div>

            <div class="grid lg:grid-cols-3 gap-6">

                {{-- Produk Disewa --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                        <h2 class="text-lg font-bold text-slate-900 mb-5">Produk Disewa</h2>

                        <div class="divide-y divide-slate-100">
                            @foreach($sewa->detailPenyewaan as $detail)
                            <div class="py-4 first:pt-0 last:pb-0">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center shrink-0">
                                            <i class="fa-solid fa-box text-slate-400"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-900">{{ $detail->produk->nama }}</p>
                                            <p class="text-sm text-slate-500 mt-0.5">
                                                {{ $detail->jumlah }} unit &middot; {{ $detail->jumlah_hari }} hari
                                            </p>
                                        </div>
                                    </div>
                                    <p class="font-bold text-slate-900 shrink-0">
                                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Ringkasan --}}
                <div>
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sticky top-24">
                        <h2 class="text-lg font-bold text-slate-900 mb-5">Ringkasan</h2>

                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Tanggal Sewa</span>
                                <span class="font-medium text-slate-900">
                                    {{ \Carbon\Carbon::parse($sewa->tanggal_sewa)->format('d M Y') }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Tanggal Kembali</span>
                                <span class="font-medium text-slate-900">
                                    {{ \Carbon\Carbon::parse($sewa->tanggal_kembali)->format('d M Y') }}
                                </span>
                            </div>
                        </div>

                        <hr class="my-4 border-slate-100">

                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Total Sewa</span>
                                <span class="font-medium text-slate-900">
                                    Rp {{ number_format($sewa->total_harga, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Total Deposit</span>
                                <span class="font-medium text-slate-900">
                                    Rp {{ number_format($sewa->total_deposit, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <hr class="my-4 border-slate-100">

                        <div class="flex justify-between items-center">
                            <span class="font-bold text-slate-900">Total Tagihan</span>
                            <span class="font-bold text-lg text-slate-900">
                                Rp {{ number_format($sewa->total_harga + $sewa->total_deposit, 0, ',', '.') }}
                            </span>
                        </div>

                        @if(session('success'))
                        <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 p-4">
                            <div class="flex items-center gap-2 text-emerald-700">
                                <i class="fa-solid fa-circle-check"></i>
                                <span class="font-semibold">
                                    {{ session('success') }}
                                </span>
                            </div>
                        </div>
                        @endif

                        @if($sewa->status === 'menunggu')
                        <a href="{{ route('pembayaran.create', $sewa->id) }}"
                            class="block text-center mt-5 bg-amber-500 hover:bg-amber-600 text-white font-semibold py-3 rounded-xl transition-colors duration-150">
                            <i class="fa-solid fa-credit-card mr-2"></i>
                            Bayar Sekarang
                        </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
