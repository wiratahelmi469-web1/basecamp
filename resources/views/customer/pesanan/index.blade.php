<x-app-layout>
    <div class="min-h-screen bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-900">Pesanan Saya</h1>
                <p class="text-slate-500 mt-1">Riwayat penyewaan perlengkapan outdoor</p>
            </div>

            {{-- List Pesanan --}}
            <div class="space-y-4">

                @forelse($sewas as $sewa)
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                                {{-- Kiri: Info Pesanan --}}
                                <div class="flex items-start gap-4">
                                    <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-tent text-amber-500"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 text-base">{{ $sewa->kode_sewa }}</p>
                                        <p class="text-sm text-slate-500 mt-0.5">
                                            <i class="fa-regular fa-calendar mr-1"></i>
                                            {{ \Carbon\Carbon::parse($sewa->tanggal_sewa)->format('d M Y') }}
                                            &rarr;
                                            {{ \Carbon\Carbon::parse($sewa->tanggal_kembali)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>

                                {{-- Kanan: Harga + Status --}}
                                <div class="flex flex-col items-start sm:items-end gap-2 sm:shrink-0">
                                    <p class="font-bold text-slate-900 text-lg">
                                        Rp {{ number_format($sewa->total_harga + $sewa->total_deposit, 0, ',', '.') }}
                                    </p>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold
                                        @if($sewa->status == 'selesai') bg-emerald-50 text-emerald-700
                                        @elseif($sewa->status == 'dipinjam' || $sewa->status == 'disewa') bg-blue-50 text-blue-700
                                        @elseif($sewa->status == 'menunggu') bg-amber-50 text-amber-700
                                        @elseif($sewa->status == 'dibatalkan') bg-red-50 text-red-700
                                        @else bg-slate-100 text-slate-600
                                        @endif">
                                        <span class="w-1.5 h-1.5 rounded-full
                                            @if($sewa->status == 'selesai') bg-emerald-500
                                            @elseif($sewa->status == 'dipinjam' || $sewa->status == 'disewa') bg-blue-500
                                            @elseif($sewa->status == 'menunggu') bg-amber-500
                                            @elseif($sewa->status == 'dibatalkan') bg-red-500
                                            @else bg-slate-400
                                            @endif">
                                        </span>
                                        {{ ucfirst($sewa->status) }}
                                    </span>
                                </div>
                            </div>

                            {{-- Tombol Detail --}}
                            <div class="mt-5 pt-5 border-t border-slate-100">
                                <a href="{{ route('pesanan.show', $sewa->id) }}"
                                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-amber-500 text-white text-sm font-semibold rounded-xl transition-colors duration-150">
                                    <i class="fa-solid fa-eye"></i>
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-16 text-center">
                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fa-solid fa-box-open text-slate-400 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Belum Ada Pesanan</h3>
                        <p class="text-slate-500 mb-6">Kamu belum pernah melakukan penyewaan.</p>
                        <a href="{{ route('produk.index') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white font-semibold rounded-xl transition-colors duration-150">
                            <i class="fa-solid fa-tent"></i>
                            Mulai Sewa
                        </a>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
