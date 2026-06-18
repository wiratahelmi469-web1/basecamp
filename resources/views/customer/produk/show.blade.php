<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back --}}
            <a href="{{ route('produk.index') }}"
                class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-slate-900 mb-6 transition-colors">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Kembali ke Katalog
            </a>

            <div class="grid lg:grid-cols-5 gap-8">

                {{-- LEFT: Gallery + Specs + Description --}}
                <div class="lg:col-span-3 space-y-6">

                    {{-- Main image --}}
                    <div class="relative bg-white rounded-2xl border border-slate-100 overflow-hidden">
                        @if($produk->foto)
                        <img id="main-image"
                            src="{{ asset('storage/' . $produk->foto) }}"
                            alt="{{ $produk->nama }}"
                            class="w-full h-[420px] md:h-[480px] object-cover">
                        @else
                        <div class="h-[420px] md:h-[480px] bg-slate-100 flex flex-col items-center justify-center gap-3">
                            <i class="fa-solid fa-image text-slate-300 text-5xl"></i>
                            <span class="text-slate-400 text-sm">Tidak Ada Foto</span>
                        </div>
                        @endif

                        <button type="button"
                            class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white/90 hover:bg-white shadow flex items-center justify-center text-slate-600">
                            <i class="fa-solid fa-magnifying-glass text-sm"></i>
                        </button>
                    </div>

                    {{-- Thumbnails: butuh relasi $produk->galeri (kolom `path`) --}}
                    @if(!empty($produk->galeri) && count($produk->galeri))
                    <div class="grid grid-cols-5 gap-3">
                        @foreach($produk->galeri as $i => $g)
                        <button type="button"
                            class="thumb-btn rounded-xl overflow-hidden border-2 transition-colors {{ $i === 0 ? 'border-amber-500' : 'border-transparent hover:border-slate-200' }}"
                            data-src="{{ asset('storage/' . $g->path) }}">
                            <img src="{{ asset('storage/' . $g->path) }}" class="w-full h-20 object-cover">
                        </button>
                        @endforeach
                    </div>
                    @endif

                    {{-- Specs --}}
                    @if($produk->kapasitas || $produk->jumlah_pintu || $produk->berat || $produk->material)
                    <div class="bg-white rounded-2xl border border-slate-100 p-5 grid grid-cols-2 sm:grid-cols-4 gap-5">
                        @if($produk->kapasitas)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400">Kapasitas</p>
                                <p class="text-sm font-semibold text-slate-900">{{ $produk->kapasitas }} Person</p>
                            </div>
                        </div>
                        @endif
                        @if($produk->jumlah_pintu)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                                <i class="fa-solid fa-door-open"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400">Pintu</p>
                                <p class="text-sm font-semibold text-slate-900">{{ $produk->jumlah_pintu }} Pintu</p>
                            </div>
                        </div>
                        @endif
                        @if($produk->berat)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                                <i class="fa-solid fa-weight-hanging"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400">Berat</p>
                                <p class="text-sm font-semibold text-slate-900">± {{ $produk->berat }} kg</p>
                            </div>
                        </div>
                        @endif
                        @if($produk->material)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                                <i class="fa-solid fa-layer-group"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400">Material</p>
                                <p class="text-sm font-semibold text-slate-900">{{ $produk->material }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    {{-- Description --}}
                    <div class="bg-white rounded-2xl border border-slate-100 p-6">
                        <h3 class="font-bold text-slate-900 mb-3">Deskripsi</h3>
                        <p class="text-slate-600 leading-relaxed text-sm">{{ $produk->deskripsi }}</p>

                        @if(!empty($produk->keunggulan))
                        <ul class="mt-4 space-y-2">
                            @foreach(is_array($produk->keunggulan) ? $produk->keunggulan : explode("\n", $produk->keunggulan) as $poin)
                            @if(trim($poin) !== '')
                            <li class="flex items-start gap-2 text-sm text-slate-600">
                                <i class="fa-solid fa-check text-emerald-500 mt-0.5"></i>
                                <span>{{ trim($poin) }}</span>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>

                {{-- RIGHT: Booking card --}}
                <div class="lg:col-span-2">
                    <div class="lg:sticky lg:top-6 space-y-6">

                        <div>
                            @if($produk->kategori)
                            <span class="inline-flex bg-amber-50 text-amber-700 text-xs font-semibold px-3 py-1 rounded-full mb-4">
                                {{ $produk->kategori->nama }}
                            </span>
                            @endif

                            <h1 class="text-3xl font-bold text-slate-900">{{ $produk->nama }}</h1>

                            <div class="mt-3 flex items-end gap-2">
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
                        </div>

                        @if($produk->stok_tersedia > 0)
                        <div class="bg-white rounded-2xl border border-slate-100 p-6">
                            <h3 class="font-bold text-slate-900 mb-5">Pilih Tanggal Sewa</h3>

                            <form id="form-keranjang" class="space-y-4">
                                <input type="hidden" id="produk_id" value="{{ $produk->id }}">

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal Sewa</label>
                                    <input type="date" id="tanggal_sewa" min="{{ date('Y-m-d') }}" required
                                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal Kembali</label>
                                    <input type="date" id="tanggal_kembali" required
                                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Jumlah Unit</label>
                                    <div class="flex items-center gap-3">
                                        <button type="button" id="qty-minus"
                                            class="w-10 h-10 rounded-full border border-slate-200 text-slate-500 hover:bg-slate-50 flex items-center justify-center">
                                            <i class="fa-solid fa-minus text-xs"></i>
                                        </button>
                                        <input type="number" id="jumlah" min="1" max="{{ $produk->stok_tersedia }}" value="1" required
                                            class="w-16 text-center rounded-xl border border-slate-200 py-2 text-sm">
                                        <button type="button" id="qty-plus"
                                            class="w-10 h-10 rounded-full border border-slate-200 text-slate-500 hover:bg-slate-50 flex items-center justify-center">
                                            <i class="fa-solid fa-plus text-xs"></i>
                                        </button>
                                        <span class="text-sm text-slate-400">Stok tersedia: {{ $produk->stok_tersedia }} unit</span>
                                    </div>
                                </div>

                                <div class="bg-slate-50 rounded-xl p-4 space-y-2">
                                    <p class="text-sm font-semibold text-slate-900 mb-1">Ringkasan Biaya</p>
                                    <div class="flex justify-between text-sm text-slate-600">
                                        <span>Harga Sewa / Hari</span>
                                        <span>Rp {{ number_format($produk->harga_sewa_per_hari, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm text-slate-600">
                                        <span>Total Hari</span>
                                        <span id="jumlah-hari">0 Hari</span>
                                    </div>
                                    <div class="flex justify-between text-sm text-slate-600">
                                        <span>Jumlah Unit</span>
                                        <span id="jumlah-unit-text">1</span>
                                    </div>
                                    <div class="flex justify-between items-center pt-2 mt-2 border-t border-slate-200">
                                        <span class="text-sm font-semibold text-slate-900">Estimasi Biaya</span>
                                        <span id="estimasi-biaya" class="text-lg font-bold text-amber-600">Rp 0</span>
                                    </div>
                                </div>

                                <button type="button" id="btn-keranjang"
                                    data-produk-id="{{ $produk->id }}"
                                    data-url="{{ route('keranjang.store') }}"
                                    data-csrf="{{ csrf_token() }}"
                                    class="w-full inline-flex items-center justify-center gap-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold px-7 py-3.5 rounded-xl transition-colors">
                                    <i id="btn-icon" class="fa-solid fa-cart-plus"></i>
                                    <span id="btn-text">Tambah ke Keranjang</span>
                                </button>
                            </form>
                        </div>
                        @else
                        <button disabled
                            class="w-full inline-flex items-center justify-center gap-2 bg-slate-200 text-slate-400 font-semibold px-7 py-3.5 rounded-xl cursor-not-allowed">
                            <i class="fa-solid fa-ban"></i>
                            Stok Habis
                        </button>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Trust badges --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-10 pt-8 border-t border-slate-200">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900">Peralatan Terawat</p>
                        <p class="text-xs text-slate-400">Semua peralatan selalu dicek sebelum disewakan</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-thumbs-up"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900">Harga Terbaik</p>
                        <p class="text-xs text-slate-400">Harga sewa bersaing dan transparan</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900">Aman & Terpercaya</p>
                        <p class="text-xs text-slate-400">Sistem aman, data kamu terlindungi</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900">Bantuan 24/7</p>
                        <p class="text-xs text-slate-400">Kami siap membantu kapan saja</p>
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
        const hargaPerHari = {{ (float) $produk->harga_sewa_per_hari }};
        const stokTersedia = {{ (int) $produk->stok_tersedia }};

        const btn = document.getElementById('btn-keranjang');
        const btnIcon = document.getElementById('btn-icon');
        const btnText = document.getElementById('btn-text');
        const toast = document.getElementById('toast');
        const toastMsg = document.getElementById('toast-msg');
        const toastIcon = document.getElementById('toast-icon');

        const tanggalSewaInput = document.getElementById('tanggal_sewa');
        const tanggalKembaliInput = document.getElementById('tanggal_kembali');
        const jumlahInput = document.getElementById('jumlah');
        const jumlahHariEl = document.getElementById('jumlah-hari');
        const jumlahUnitTextEl = document.getElementById('jumlah-unit-text');
        const estimasiBiayaEl = document.getElementById('estimasi-biaya');
        const mainImage = document.getElementById('main-image');

        const badgeDesktop = document.getElementById('cart-badge-desktop');
        const badgeMobile = document.getElementById('cart-badge-mobile');
        const badgeInline = document.getElementById('nav-cart-count-inline');

        function formatRupiah(angka) {
            return 'Rp ' + Math.round(angka).toLocaleString('id-ID');
        }

        function updateSummary() {
            const sewa = tanggalSewaInput?.value;
            const kembali = tanggalKembaliInput?.value;
            const jumlah = parseInt(jumlahInput?.value || '1', 10);

            let totalHari = 0;
            if (sewa && kembali) {
                const diff = Math.round((new Date(kembali) - new Date(sewa)) / 86400000);
                totalHari = diff > 0 ? diff : 0;
            }

            if (jumlahHariEl) jumlahHariEl.textContent = totalHari + ' Hari';
            if (jumlahUnitTextEl) jumlahUnitTextEl.textContent = jumlah;
            if (estimasiBiayaEl) estimasiBiayaEl.textContent = formatRupiah(totalHari * jumlah * hargaPerHari);
        }

        [tanggalSewaInput, tanggalKembaliInput, jumlahInput].forEach(el => {
            el?.addEventListener('change', updateSummary);
            el?.addEventListener('input', updateSummary);
        });

        document.getElementById('qty-minus')?.addEventListener('click', () => {
            jumlahInput.value = Math.max(1, parseInt(jumlahInput.value || '1', 10) - 1);
            updateSummary();
        });
        document.getElementById('qty-plus')?.addEventListener('click', () => {
            jumlahInput.value = Math.min(stokTersedia, parseInt(jumlahInput.value || '1', 10) + 1);
            updateSummary();
        });

        document.querySelectorAll('.thumb-btn').forEach(thumb => {
            thumb.addEventListener('click', () => {
                document.querySelectorAll('.thumb-btn').forEach(t => t.classList.remove('border-amber-500'));
                thumb.classList.add('border-amber-500');
                if (mainImage) mainImage.src = thumb.dataset.src;
            });
        });

        function showToast(message, type = 'success') {
            const isSuccess = type === 'success';
            toast.className = toast.className.replace(/bg-\S+/g, '').replace(/text-\S+/g, '');
            toast.classList.add(
                isSuccess ? 'bg-emerald-500' : 'bg-red-500', 'text-white',
                'fixed', 'bottom-24', 'md:bottom-6', 'right-6', 'z-50',
                'flex', 'items-center', 'gap-3', 'px-5', 'py-4',
                'rounded-2xl', 'shadow-xl', 'text-sm', 'font-semibold',
                'transition-all', 'duration-300'
            );
            toastIcon.innerHTML = isSuccess ? '<i class="fa-solid fa-check"></i>' : '<i class="fa-solid fa-xmark"></i>';
            toastIcon.className = `w-8 h-8 rounded-xl flex items-center justify-center shrink-0 text-base ${isSuccess ? 'bg-emerald-400' : 'bg-red-400'}`;
            toastMsg.textContent = message;

            toast.style.opacity = '1';
            toast.style.transform = 'translateY(0)';
            clearTimeout(toast._timer);
            toast._timer = setTimeout(() => {
                toast.style.opacity = '0';
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
                const tanggalSewa = tanggalSewaInput.value;
                const tanggalKembali = tanggalKembaliInput.value;
                const jumlah = jumlahInput.value;

                if (!tanggalSewa || !tanggalKembali) {
                    showToast('Pilih tanggal sewa dan tanggal kembali', 'error');
                    return;
                }
                if (jumlah < 1) {
                    showToast('Jumlah minimal 1 unit', 'error');
                    return;
                }

                btn.disabled = true;
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
                        body: JSON.stringify({
                            produk_id: btn.dataset.produkId,
                            tanggal_sewa: tanggalSewa,
                            tanggal_kembali: tanggalKembali,
                            jumlah: jumlah
                        }),
                    });

                    const data = await res.json();

                    if (res.ok) {
                        showToast(data.message || 'Produk ditambahkan ke keranjang!');
                        updateBadge(data.cart_count);
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
