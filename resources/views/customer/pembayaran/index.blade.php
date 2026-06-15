<x-app-layout>
    <div class="min-h-screen bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-900">Riwayat Pembayaran</h1>
                <p class="text-slate-500 mt-1">Semua transaksi pembayaran penyewaanmu.</p>
            </div>

            <div class="space-y-4">

                @forelse($pembayaran as $item)
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow duration-200 p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                        {{-- Kiri --}}
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-receipt text-amber-500"></i>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">{{ $item->kode_pembayaran }}</p>
                                <p class="text-sm text-slate-500 mt-0.5 capitalize">
                                    <i class="fa-solid fa-credit-card mr-1 text-slate-400"></i>
                                    {{ str_replace('_', ' ', $item->metode) }}
                                </p>
                                @if($item->dibayar_pada)
                                <p class="text-xs text-slate-400 mt-0.5">
                                    <i class="fa-regular fa-clock mr-1"></i>
                                    {{ \Carbon\Carbon::parse($item->dibayar_pada)->format('d M Y, H:i') }}
                                </p>
                                @endif
                            </div>
                        </div>

                        {{-- Kanan --}}
                        <div class="flex flex-col items-start sm:items-end gap-2 shrink-0">
                            <p class="font-bold text-slate-900 text-lg">
                                Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                            </p>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold
                                    @if($item->status == 'berhasil') bg-emerald-50 text-emerald-700
                                    @elseif($item->status == 'menunggu') bg-amber-50 text-amber-700
                                    @else bg-red-50 text-red-700
                                    @endif">
                                <span class="w-1.5 h-1.5 rounded-full
                                        @if($item->status == 'berhasil') bg-emerald-500
                                        @elseif($item->status == 'menunggu') bg-amber-500
                                        @else bg-red-500
                                        @endif">
                                </span>
                                {{ ucfirst($item->status) }}
                            </span>
                        </div>

                    </div>
                </div>

                @empty
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-16 text-center">
                    <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-receipt text-slate-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Belum Ada Pembayaran</h3>
                    <p class="text-slate-500 mb-6">Riwayat pembayaranmu akan muncul di sini.</p>
                    <a href="{{ route('produk.index') }}"
                        class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-xl transition-colors duration-150">
                        <i class="fa-solid fa-tent"></i>
                        Mulai Sewa
                    </a>
                </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
