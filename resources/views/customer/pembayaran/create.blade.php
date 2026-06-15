<x-app-layout>
    <div class="min-h-screen bg-slate-50">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- Back --}}
            <a href="{{ route('pesanan.index') }}"
                class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-slate-900 mb-6 transition-colors">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Kembali ke Pesanan
            </a>

            {{-- Info Sewa --}}
            <div class="bg-amber-50 border border-amber-100 rounded-2xl p-5 mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-tent text-amber-600"></i>
                    </div>
                    <div>
                        <p class="text-xs text-amber-600 font-semibold uppercase tracking-wide">Kode Sewa</p>
                        <p class="font-bold text-slate-900">{{ $sewa->kode_sewa }}</p>
                    </div>
                    <div class="ml-auto text-right">
                        <p class="text-xs text-amber-600 font-semibold uppercase tracking-wide">Total Tagihan</p>
                        <p class="font-bold text-slate-900 text-lg">
                            Rp {{ number_format($sewa->total_harga + $sewa->total_deposit, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h1 class="text-2xl font-bold text-slate-900 mb-6">Form Pembayaran</h1>

                <form method="POST" action="{{ route('pembayaran.store', $sewa->id) }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Metode Pembayaran --}}
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Metode Pembayaran
                        </label>
                        <select name="metode"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition">
                            <option value="transfer_bank">Transfer Bank</option>
                            <option value="qris">QRIS</option>
                            <option value="ewallet">E-Wallet</option>
                        </select>
                        <x-input-error :messages="$errors->get('metode')" class="mt-2" />
                    </div>

                    {{-- Bukti Pembayaran --}}
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Bukti Pembayaran
                        </label>
                        <div class="relative">
                            <input type="file" name="bukti_bayar" accept="image/*"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition
                                          file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                        </div>
                        <x-input-error :messages="$errors->get('bukti_bayar')" class="mt-2" />
                    </div>

                    {{-- Catatan --}}
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Catatan <span class="font-normal text-slate-400">(opsional)</span>
                        </label>
                        <textarea name="catatan" rows="4"
                            placeholder="Tambahkan catatan untuk admin..."
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition resize-none"></textarea>
                        <x-input-error :messages="$errors->get('catatan')" class="mt-2" />
                    </div>

                    <button type="submit"
                        class="w-full bg-amber-500 hover:bg-amber-600 text-white font-semibold py-3 rounded-xl transition-colors duration-150 shadow-[0_4px_14px_rgba(245,158,11,0.3)]">
                        <i class="fa-solid fa-paper-plane mr-2"></i>
                        Kirim Pembayaran
                    </button>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>
