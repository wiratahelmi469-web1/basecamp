<x-app-layout>
    <div class="min-h-screen bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- Back --}}
            <a href="{{ route('produk.index') }}"
               class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-slate-900 mb-6 transition-colors">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Kembali ke Katalog
            </a>

            <div class="grid md:grid-cols-2 gap-10">

                {{-- Foto --}}
                <div class="rounded-2xl overflow-hidden border border-slate-100 shadow-sm bg-white">
                    @if($produk->foto)
                        <img src="{{ asset('storage/' . $produk->foto) }}"
                             alt="{{ $produk->nama }}"
                             class="w-full h-full object-cover max-h-[480px]">
                    @else
                        <div class="h-96 bg-slate-100 flex flex-col items-center justify-center gap-3">
                            <i class="fa-solid fa-image text-slate-300 text-5xl"></i>
                            <span class="text-slate-400 text-sm">Tidak Ada Foto</span>
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex flex-col">

                    @if($produk->kategori)
                        <span class="inline-flex self-start bg-amber-50 text-amber-700 text-xs font-semibold px-3 py-1 rounded-full mb-4">
                            {{ $produk->kategori->nama }}
                        </span>
                    @endif

                    <h1 class="text-3xl font-bold text-slate-900">{{ $produk->nama }}</h1>

                    <div class="mt-5 flex items-end gap-2">
                        <span class="text-4xl font-bold text-slate-900">
                            Rp {{ number_format($produk->harga_sewa_per_hari, 0, ',', '.') }}
                        </span>
                        <span class="text-slate-400 text-base mb-1">/ hari</span>
                    </div>

                    <div class="mt-4">
                        <span id="stok-badge" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-semibold
                            {{ $produk->stok_tersedia > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $produk->stok_tersedia > 0 ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                            {{ $produk->stok_tersedia > 0 ? 'Stok: ' . $produk->stok_tersedia . ' tersedia' : 'Stok Habis' }}
                        </span>
                    </div>

                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <h3 class="font-bold text-slate-900 mb-3">Deskripsi</h3>
                        <p class="text-slate-600 leading-relaxed text-sm">{{ $produk->deskripsi }}</p>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex gap-3 mt-8">
                        @if($produk->stok_tersedia > 0)
                            <button
                                id="btn-keranjang"
                                data-produk-id="{{ $produk->id }}"
                                data-url="{{ route('keranjang.store') }}"
                                data-csrf="{{ csrf_token() }}"
                                class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 active:scale-95 text-white font-semibold px-7 py-3.5 rounded-xl transition-all duration-150">
                                <i id="btn-icon" class="fa-solid fa-cart-plus"></i>
                                <span id="btn-text">Tambah ke Keranjang</span>
                            </button>
                        @else
                            <button disabled
                                    class="inline-flex items-center gap-2 bg-slate-200 text-slate-400 font-semibold px-7 py-3.5 rounded-xl cursor-not-allowed">
                                <i class="fa-solid fa-ban"></i>
                                Stok Habis
                            </button>
                        @endif

                        <a href="{{ route('keranjang.index') }}"
                           class="inline-flex items-center gap-2 border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold px-7 py-3.5 rounded-xl transition-colors duration-150">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="hidden sm:inline">Keranjang</span>
                            <span id="nav-cart-count-inline" class="bg-red-500 text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center">
                                {{ auth()->check() ? \App\Models\Keranjang::where('user_id', auth()->id())->count() : 0 }}
                            </span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Toast Notification --}}
    <div id="toast"
         class="fixed bottom-24 md:bottom-6 right-6 z-50 flex items-center gap-3 px-5 py-4 rounded-2xl shadow-xl text-sm font-semibold
                translate-y-16 opacity-0 transition-all duration-300 pointer-events-none"
         style="min-width: 260px;">
        <div id="toast-icon" class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0 text-base"></div>
        <span id="toast-msg"></span>
    </div>

    <script>
        const btn       = document.getElementById('btn-keranjang');
        const btnIcon   = document.getElementById('btn-icon');
        const btnText   = document.getElementById('btn-text');
        const toast     = document.getElementById('toast');
        const toastMsg  = document.getElementById('toast-msg');
        const toastIcon = document.getElementById('toast-icon');

        // Badge elements (navbar desktop + mobile + inline)
        const badgeDesktop = document.getElementById('cart-badge-desktop');
        const badgeMobile  = document.getElementById('cart-badge-mobile');
        const badgeInline  = document.getElementById('nav-cart-count-inline');

        function showToast(message, type = 'success') {
            const isSuccess = type === 'success';
            toast.className = toast.className
                .replace(/bg-\S+/g, '')
                .replace(/text-\S+/g, '');

            toast.classList.add(
                isSuccess ? 'bg-emerald-500' : 'bg-red-500',
                'text-white',
                'fixed', 'bottom-24', 'md:bottom-6', 'right-6', 'z-50',
                'flex', 'items-center', 'gap-3', 'px-5', 'py-4',
                'rounded-2xl', 'shadow-xl', 'text-sm', 'font-semibold',
                'transition-all', 'duration-300'
            );

            toastIcon.innerHTML = isSuccess
                ? '<i class="fa-solid fa-check"></i>'
                : '<i class="fa-solid fa-xmark"></i>';
            toastIcon.className = `w-8 h-8 rounded-xl flex items-center justify-center shrink-0 text-base ${isSuccess ? 'bg-emerald-400' : 'bg-red-400'}`;
            toastMsg.textContent = message;

            // Show
            toast.style.opacity   = '1';
            toast.style.transform = 'translateY(0)';

            // Hide after 3s
            clearTimeout(toast._timer);
            toast._timer = setTimeout(() => {
                toast.style.opacity   = '0';
                toast.style.transform = 'translateY(16px)';
            }, 3000);
        }

        function updateBadge(count) {
            [badgeDesktop, badgeMobile, badgeInline].forEach(el => {
                if (!el) return;
                el.textContent = count;
                el.style.display = count > 0 ? '' : 'none';
            });
        }

        if (btn) {
            btn.addEventListener('click', async () => {
                // Loading state
                btn.disabled  = true;
                btnIcon.className = 'fa-solid fa-spinner fa-spin';
                btnText.textContent = 'Menambahkan...';

                try {
                    const res = await fetch(btn.dataset.url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': btn.dataset.csrf,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({ produk_id: btn.dataset.produkId }),
                    });

                    const data = await res.json();

                    if (res.ok) {
                        showToast(data.message || 'Produk ditambahkan ke keranjang!');
                        updateBadge(data.cart_count);

                        // Checkmark sebentar
                        btnIcon.className = 'fa-solid fa-check';
                        btnText.textContent = 'Ditambahkan!';
                        setTimeout(() => {
                            btnIcon.className = 'fa-solid fa-cart-plus';
                            btnText.textContent = 'Tambah ke Keranjang';
                            btn.disabled = false;
                        }, 1500);
                    } else {
                        showToast(data.message || 'Gagal menambahkan produk.', 'error');
                        btnIcon.className = 'fa-solid fa-cart-plus';
                        btnText.textContent = 'Tambah ke Keranjang';
                        btn.disabled = false;
                    }

                } catch (e) {
                    showToast('Terjadi kesalahan. Coba lagi.', 'error');
                    btnIcon.className = 'fa-solid fa-cart-plus';
                    btnText.textContent = 'Tambah ke Keranjang';
                    btn.disabled = false;
                }
            });
        }
    </script>

</x-app-layout>
