<x-app-layout>
    <div class="min-h-screen bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-900">Katalog Produk</h1>
                <p class="text-slate-500 mt-1">Pilih perlengkapan outdoor terbaik untuk petualanganmu.</p>
            </div>

            {{-- Search & Filter --}}
            <form method="GET" action="{{ route('produk.index') }}" id="filter-form">
                <div class="flex flex-wrap gap-3 mb-8">

                    {{-- Search Produk --}}
                    <div class="relative max-w-xl w-full sm:w-auto sm:flex-1">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input
                            type="text"
                            name="search"
                            id="search-input"
                            value="{{ request('search') }}"
                            placeholder="Cari produk... contoh: tenda, carrier, sleeping bag"
                            class="w-full pl-12 pr-4 py-3 rounded-2xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                    </div>

                    {{-- Filter Kategori --}}
                    <select
                        name="kategori"
                        id="kategori-filter"
                        class="pl-4 pr-8 py-3 rounded-2xl border border-slate-200 bg-white text-slate-700 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>

                </div>
            </form>

            {{-- Grid Produk --}}
            @if($produks->isEmpty())
                <div class="flex flex-col items-center justify-center py-24 text-center">
                    <i class="fa-solid fa-box-open text-slate-300 text-5xl mb-4"></i>
                    <h3 class="text-lg font-semibold text-slate-500">Produk tidak ditemukan</h3>
                    <p class="text-sm text-slate-400 mt-1">Coba kata kunci lain atau ubah filter kategori.</p>
                    <a href="{{ route('produk.index') }}" class="mt-5 text-sm font-semibold text-amber-500 hover:underline">
                        Tampilkan semua produk
                    </a>
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">

                    @foreach($produks as $produk)
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 overflow-hidden group">

                        {{-- Foto --}}
                        <div class="relative h-48 overflow-hidden">
                            @if($produk->foto)
                            <img src="{{ asset('storage/' . $produk->foto) }}"
                                alt="{{ $produk->nama }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                            <div class="w-full h-full bg-slate-100 flex flex-col items-center justify-center gap-2">
                                <i class="fa-solid fa-image text-slate-300 text-3xl"></i>
                                <span class="text-xs text-slate-400">Tidak Ada Foto</span>
                            </div>
                            @endif

                            @if($produk->kategori)
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-slate-700 text-xs font-semibold px-2.5 py-1 rounded-full shadow-sm">
                                {{ $produk->kategori->nama }}
                            </span>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="p-4">
                            <h3 class="font-semibold text-slate-900 text-sm leading-snug line-clamp-2">
                                {{ $produk->nama }}
                            </h3>

                            <div class="mt-3">
                                <p class="text-xs text-slate-400">Harga sewa</p>
                                <p class="font-bold text-slate-900 text-base">
                                    Rp {{ number_format($produk->harga_sewa_per_hari, 0, ',', '.') }}
                                    <span class="text-xs font-normal text-slate-400">/hari</span>
                                </p>
                            </div>

                            <a href="{{ route('produk.show', $produk->id) }}"
                                class="block text-center mt-4 bg-slate-900 hover:bg-amber-500 text-white text-sm font-semibold py-2.5 rounded-xl transition-colors duration-150">
                                Lihat Detail
                            </a>
                        </div>

                    </div>
                    @endforeach

                </div>

                {{-- Pagination — pertahankan query string search & kategori --}}
                <div class="mt-10">
                    {{ $produks->appends(request()->query())->links() }}
                </div>
            @endif

        </div>
    </div>

    {{-- Auto-submit saat search/filter berubah --}}
    @push('scripts')
    <script>
        const form = document.getElementById('filter-form');
        const searchInput = document.getElementById('search-input');
        const kategoriFilter = document.getElementById('kategori-filter');

        // Debounce search agar tidak submit tiap huruf
        let searchTimer;
        searchInput.addEventListener('input', () => {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => form.submit(), 500);
        });

        // Langsung submit saat kategori dipilih
        kategoriFilter.addEventListener('change', () => form.submit());
    </script>
    @endpush

</x-app-layout>
