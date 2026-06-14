<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
       
    <meta charset="utf-8">
       
    <meta name="viewport" content="width=device-width, initial-scale=1">
       
    <meta name="csrf-token" content="{{ csrf_token() }}">
       
    <link rel="icon" href="{{ $setting?->faviconImage }}" type="image/x-icon" />
        {!! \Firefly\FilamentBlog\Facades\SEOMeta::generate() !!}
        {!! $setting?->google_console_code !!}
        {!! $setting?->google_analytic_code !!}
        {!! $setting?->google_adsense_code !!}

       
    <link rel="preconnect" href="https://fonts.googleapis.com">
       
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
       
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script>
        tailwind.config = {
            theme: {
                container: {
                    padding: {
                        DEFAULT: '1rem',
                        sm: '2rem',
                    },
                    center: true,
                },
                extend: {
                    colors: {
                        'primary': {
                            DEFAULT: '#15803d',
                            /* Hijau Gunung khas Basecamp Outdoor */
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                            950: '#052e16'
                        },
                        'dark-slate': '#1e293b'
                    }
                }
            }
        }
    </script>
        <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f8fafc;
        }

        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        /* Artikel Styling */
        article h1 {
            line-height: 1.2;
            font-size: 2.25rem;
            color: #1e293b;
            font-weight: 800;
            padding-bottom: 20px;
        }

        article h2 {
            line-height: 1.3;
            font-size: 1.75rem;
            color: #334155;
            font-weight: 700;
            padding-top: 1.5rem;
            padding-bottom: 10px;
        }

        article h3 {
            line-height: 1.3;
            font-size: 1.4rem;
            color: #334155;
            font-weight: 600;
            padding-top: 1rem;
            padding-bottom: 10px;
        }

        article p {
            line-height: 1.8;
            letter-spacing: .1px;
            font-size: 1.05rem;
            color: #475569;
            margin-bottom: 1.25rem;
        }

        article ul {
            line-height: 1.8;
            padding-left: 1.5rem;
            list-style-type: disc;
            margin-bottom: 1.25rem;
            color: #475569;
        }

        article table {
            margin: 2rem 0;
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        article table border,
        article table td,
        article table th {
            border: 1px solid #e2e8f0;
            padding: 10px 14px;
        }

        article table th {
            background-color: #f1f5f9;
            color: #1e293b;
            font-weight: 600;
        }

        /* Share Buttons Adjustments */
        .sharethis-inline-share-buttons {
            display: flex !important;
            gap: 8px;
        }

        .sharethis-inline-share-buttons .st-btn {
            width: 40px !important;
            height: 40px !important;
            border-radius: 50% !important;
        }
    </style>
</head>

<body class="antialiased text-slate-800">
        <div class="min-h-screen flex flex-col justify-between pb-20 sm:pb-0">

                <div class="bg-slate-900 text-white text-xs py-2 px-4">
                        <div class="max-w-7xl mx-auto flex justify-between items-center">
                                <span class="hidden sm:inline text-slate-400">Mau sewa alat camping terdekat?</span>
                                <a href="/" class="inline-flex items-center gap-1 text-primary-400 hover:text-white font-medium transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m15 18-6-6 6-6" />
                    </svg>
                                        Kembali ke Marketplace Rental
                                    </a>
                            </div>
                    </div>

                <header class="bg-white/90 backdrop-blur sticky top-0 z-40 border-b border-slate-100 shadow-sm transition-all">
                        <div class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">
                                <a href="{{ route('filamentblog.post.index') }}" class="flex items-center gap-2">
                                        @if($setting?->logoImage)
                                            <img src="{{ $setting->logoImage }}" alt="Logo" class="h-8 w-auto object-contain">
                                        @endif
                                        <div class="flex flex-col">
                                                <span class="text-base font-bold text-slate-900 tracking-tight leading-none mb-0.5">Basecamp Outdoor</span>
                                                <span class="text-[10px] font-semibold tracking-wider text-primary uppercase bg-primary-50 px-1.5 py-0.5 rounded-md w-max">Edu-Blog</span>
                                            </div>
                                    </a>

                                <nav class="hidden sm:flex items-center gap-6 text-sm font-medium text-slate-600">
                                        <a href="{{ route('filamentblog.post.index') }}" class="hover:text-primary transition">Beranda Blog</a>
                                        <a href="{{ route('filamentblog.post.all') }}" class="hover:text-primary transition">Semua Artikel</a>
                                        <a href="/syarat-ketentuan" class="hover:text-primary transition">Info Rental</a>
                                    </nav>
                            </div>
                    </header>

                @if(request()->routeIs('filamentblog.post.index'))
                <section class="bg-gradient-to-br from-slate-900 via-emerald-950 to-slate-950 text-white py-12 md:py-20 px-4 relative overflow-hidden">
                        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:16px_16px]"></div>
                        <div class="max-w-4xl mx-auto text-center relative z-10">
                                <span class="text-xs md:text-sm font-semibold tracking-widest text-primary-400 uppercase bg-primary-950/60 px-3 py-1.5 rounded-full border border-primary-900/50">
                                        Panduan & Inspirasi Petualangan
                                    </span>
                                <h1 class="text-3xl md:text-5xl font-black mt-4 md:mt-6 tracking-tight leading-tight">
                                        Eksplor Alam Liar dengan <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-green-300">Persiapan Matang</span>
                                    </h1>
                                <p class="text-sm md:text-lg text-slate-300 mt-4 max-w-2xl mx-auto font-light leading-relaxed">
                                        Kumpulan tips mendaki, review alat outdoor, rute gunung, hingga panduan bertahan hidup terlengkap dari tim Basecamp Outdoor.
                                    </p>
                            </div>
                    </section>
                @endif

                <main class="flex-grow">
                        {{ $slot }}
                    </main>

                <footer class="bg-slate-900 text-slate-400 border-t border-slate-800 px-4 py-12 sm:py-16">
                        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10">
                                <div class="flex flex-col gap-4">
                                        <h4 class="text-lg font-bold text-white">{{ $setting?->title ?? 'Basecamp Outdoor' }}</h4>
                                        <p class="text-sm leading-relaxed text-slate-400">
                                                {{ $setting?->description ?? 'Penyedia layanan sewa alat outdoor premium dan terpercaya. Temukan perlengkapan petualangan terbaik Anda di sini.' }}
                                            </p>
                                    </div>

                                <div class="flex flex-col gap-4">
                                        <h4 class="text-sm font-semibold text-slate-200 uppercase tracking-wider">{{__('filament-blog::blog-views.layout.footer.quick_links')}}</h4>
                                        <div class="grid grid-cols-1 gap-2.5 text-sm">
                                                @forelse($setting->quick_links ?? [] as $link)
                                                    <a href="{{ $link['url'] }}" class="hover:text-primary-400 transition transform hover:translate-x-1 duration-200">
                                                            {{ $link['label'] }}
                                                        </a>
                                                @empty
                                                    <a href="/" class="hover:text-primary-400 transition">Katalog Rental Alat</a>
                                                    <a href="{{ route('filamentblog.post.all') }}" class="hover:text-primary-400 transition">Semua Artikel Blog</a>
                                                    <a href="/Kontak" class="hover:text-primary-400 transition">Hubungi Basecamp</a>
                                                @endforelse
                                            </div>
                                    </div>

                                <div class="flex flex-col gap-4">
                                        <h4 class="text-sm font-semibold text-slate-200 uppercase tracking-wider">{{__('filament-blog::blog-views.layout.footer.newsletter_title')}}</h4>
                                        <p class="text-sm text-slate-400">{{__('filament-blog::blog-views.layout.footer.newsletter_desc')}}</p>

                                        <form method="post" action="{{ route('filamentblog.post.subscribe') }}" class="mt-2">
                                                @csrf
                                                @error('email')
                                                    <span class="text-xs text-red-400 mb-1 block">{{ $message }}</span>
                                                @enderror
                                                <div class="relative flex items-center">
                                                        <input autocomplete="email" name="email" value="{{ old('email') }}" placeholder="Alamat email Anda..." type="email"
                                                                class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3.5 text-sm text-white outline-none focus:border-primary placeholder:text-slate-500 transition">
                                                        <button type="submit" class="absolute right-2 p-2 bg-primary hover:bg-primary-600 text-white rounded-lg transition group">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-0.5 transition" viewBox="0 0 256 256">
                                                                       
                                    <path fill="currentColor" d="m220.24 132.24l-72 72a6 6 0 0 1-8.48-8.48L201.51 134H40a6 6 0 0 1 0-12h161.51l-61.75-61.76a6 6 0 0 1 8.48-8.48l72 72a6 6 0 0 1 0 8.48" />
                                                                   
                                </svg>
                                                            </button>
                                                    </div>
                                                @if (session('success'))
                                                    <span class="text-xs text-green-400 mt-2 block">{{ session('success') }}</span>
                                                @endif
                                            </form>
                                    </div>
                            </div>

                        <div class="max-w-7xl mx-auto mt-12 pt-6 border-t border-slate-800 text-center text-xs text-slate-500">
                                © {{ now()->year }} {{ $setting->organization_name ?? 'Basecamp Outdoor' }}. Hak Cipta Dilindungi.
                            </div>
                    </footer>

                <div class="fixed bottom-0 left-0 z-50 h-16 w-full border-t border-slate-200 bg-white/95 backdrop-blur shadow-lg sm:hidden">
                        <div class="mx-auto grid h-full grid-cols-3 justify-center text-center font-medium">
                                <a href="/" class="flex flex-col items-center justify-center text-slate-500 hover:text-primary transition gap-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                               
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h2.64m-4.64 0V9.812a1.5 1.5 0 0 0-.516-1.124l-3.37-2.91a1.5 1.5 0 0 0-1.978 0l-3.37 2.91A1.5 1.5 0 0 0 5.64 9.812V21M18 10.5h1.875c.621 0 1.125.504 1.125 1.125v9.375m-14.25-10.5H3.375A1.125 1.125 0 0 0 2.25 11.625v9.375M12 14.25h.008v.008H12v-.008Z" />
                                           
                    </svg>
                                        <span class="text-[10px]">Sewa Alat</span>
                                    </a>
                                <a href="{{ route('filamentblog.post.index') }}" class="{{ request()->routeIs('filamentblog.post.index') ? 'text-primary font-semibold' : 'text-slate-500' }} flex flex-col items-center justify-center hover:text-primary transition gap-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                               
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125H3.375A1.125 1.125 0 0 1 2.25 20.25V4.875c0-.621.504-1.125 1.125-1.125H3.75m16.5 0h1.875c.621 0 1.125.504 1.125 1.125v13.5c0 .621-.504 1.125-1.125 1.125H6.75a9.06 9.06 0 0 1-1.5-.124m15-13.376A8.96 8.96 0 0 0 12 3.75a8.96 8.96 0 0 0-6.75 3.001" />
                                           
                    </svg>
                                        <span class="text-[10px]">Edukasi Blog</span>
                                    </a>
                                <a href="{{ route('filamentblog.post.all') }}" class="{{ request()->routeIs('filamentblog.post.all') ? 'text-primary font-semibold' : 'text-slate-500' }} flex flex-col items-center justify-center hover:text-primary transition gap-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                               
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H19.5A2.25 2.25 0 0 1 21.75 6v2.25a2.25 2.25 0 0 1-2.25 2.25H16.5A2.25 2.25 0 0 1 13.5 8.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H19.5a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H16.5A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                                           
                    </svg>
                                        <span class="text-[10px]">Index Artikel</span>
                                    </a>
                            </div>
                    </div>
            </div>

        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script>
        function onSubmit(token) {
            document.getElementById("comment-box").submit();
        }
    </script>
</body>

</html>
