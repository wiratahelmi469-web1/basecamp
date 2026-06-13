```blade
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Basecamp Outdoor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Inter, sans-serif;
        }

        .navbar {
            backdrop-filter: blur(10px);
        }

        .hero {
            min-height: 100vh;
            background:
                linear-gradient(rgba(0, 0, 0, .6),
                    rgba(0, 0, 0, .6)),
                url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b');
            background-size: cover;
            background-position: center;
            color: white;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 800;
        }

        .stats-section {
            background: #111827;
            color: white;
        }

        .stats-number {
            font-size: 3rem;
            font-weight: 800;
        }

        .category-card {
            border: none;
            border-radius: 20px;
            transition: .3s;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
        }

        .category-card:hover {
            transform: translateY(-8px);
        }

        .product-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: .3s;
            box-shadow: 0 5px 25px rgba(0, 0, 0, .08);
        }

        .product-card:hover {
            transform: translateY(-8px);
        }

        .product-card img {
            height: 280px;
            object-fit: cover;
        }

        .feature-box {
            padding: 30px;
            border-radius: 20px;
            background: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
            height: 100%;
        }

        .cta-section {
            background: #111827;
            color: white;
        }

        footer {
            background: #0f172a;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

        <div class="container">

            <a class="navbar-brand fw-bold" href="/">
                🏕 Basecamp Outdoor
            </a>

            <button class="navbar-toggler"
                data-bs-toggle="collapse"
                data-bs-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="#">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#kategori">
                            Kategori
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#produk">
                            Produk
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#artikel">
                            Artikel
                        </a>
                    </li>

                </ul>

                <a href="/customer/sewa"
                    class="btn btn-success btn-lg">
                    Sewa Sekarang
                </a>

            </div>

        </div>

    </nav>

    <section class="hero d-flex align-items-center">

        <div class="container">

            <div class="row">

                <div class="col-lg-7">

                    <h1 class="display-1 fw-bold">
                        Mulai Petualanganmu
                    </h1>

                    <h2 class="display-4 fw-bold mb-4">
                        Tanpa Harus Membeli
                        Peralatan Mahal
                    </h2>

                    <p class="lead">
                        Sewa tenda, carrier,
                        sleeping bag, cooking set
                        dan perlengkapan outdoor terbaik
                        untuk perjalananmu.
                    </p>

                    <div class="mt-4">

                        <a href="#produk"
                            class="btn btn-success btn-lg me-2">
                            Lihat Produk
                        </a>

                        <a href="/admin"
                            class="btn btn-outline-light btn-lg">
                            Mulai Sewa
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <section class="stats-section py-5">

        <div class="container">

            <div class="row text-center">

                <div class="col-md-4">

                    <div class="stats-number">
                        {{ $totalProduk }}
                    </div>

                    <p>Produk Outdoor</p>

                </div>

                <div class="col-md-4">

                    <div class="stats-number">
                        {{ $totalPenyewaan }}
                    </div>

                    <p>Penyewaan</p>

                </div>

                <div class="col-md-4">

                    <div class="stats-number">
                        {{ $totalCustomer }}
                    </div>

                    <p>Customer</p>

                </div>

            </div>

        </div>

    </section>

    <section id="kategori" class="py-5 bg-light">

        <div class="container">

            <h2 class="section-title text-center mb-5">
                Kategori Outdoor
            </h2>

            <div class="row">

                @foreach ($kategori as $item)
                <div class="col-md-3 mb-4">

                    <div class="card category-card h-100">

                        <div class="card-body text-center">

                            <div style="font-size:50px">
                                🏕
                            </div>

                            <h4>
                                {{ $item->nama }}
                            </h4>

                            <p class="text-muted">
                                {{ $item->produk_count }}
                                Produk
                            </p>

                        </div>

                    </div>

                </div>
                @endforeach

            </div>

        </div>

    </section>

    <section class="py-5">

        <div class="container">

            <h2 class="section-title text-center mb-5">
                Kenapa Memilih Kami?
            </h2>

            <div class="row g-4">

                <div class="col-md-3">

                    <div class="feature-box text-center">

                        <h1>🏕</h1>

                        <h5>Peralatan Lengkap</h5>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="feature-box text-center">

                        <h1>✨</h1>

                        <h5>Bersih & Terawat</h5>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="feature-box text-center">

                        <h1>⚡</h1>

                        <h5>Proses Cepat</h5>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="feature-box text-center">

                        <h1>💰</h1>

                        <h5>Harga Terjangkau</h5>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <section id="produk" class="py-5 bg-light">

        <div class="container">

            <h2 class="section-title mb-5">
                Produk Terbaru
            </h2>

            <div class="row">

                @foreach ($produkTerbaru as $produk)

                <div class="col-md-4 mb-4">

                    <div class="card product-card h-100">

                        @if ($produk->foto)
                        <img
                            src="{{ asset('storage/' . $produk->foto) }}"
                            alt="{{ $produk->nama }}">
                        @endif

                        <div class="card-body">

                            <h4>
                                {{ $produk->nama }}
                            </h4>

                            <p class="text-muted">
                                {{ $produk->merek }}
                            </p>

                            <strong class="fs-5">
                                Rp {{ number_format($produk->harga_sewa_per_hari, 0, ',', '.') }}/hari
                            </strong>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </section>

    <section id="artikel" class="py-5">

        <div class="container">

            <h2 class="section-title mb-5">
                Artikel Terbaru
            </h2>

            <div class="row">

                @foreach ($artikelTerbaru as $artikel)

                <div class="col-md-4 mb-4">

                    <div class="card product-card h-100">

                        @if ($artikel->thumbnail)

                        <img
                            src="{{ asset('storage/' . $artikel->thumbnail) }}"
                            alt="{{ $artikel->title }}">

                        @endif

                        <div class="card-body">

                            <h5>
                                {{ $artikel->title }}
                            </h5>

                            <p class="text-muted">
                                {{ $artikel->excerpt }}
                            </p>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </section>

    <section class="cta-section py-5">

        <div class="container text-center">

            <h2 class="display-5 fw-bold">
                Siap Memulai Petualangan?
            </h2>

            <p class="lead">
                Sewa perlengkapan outdoor terbaik
                tanpa harus membeli sendiri.
            </p>

            <a href="/customer/sewa"
                class="btn btn-outline-light btn-lg">
                Mulai Sewa
            </a>

        </div>

    </section>

    <footer class="text-white py-5">

        <div class="container text-center">

            <h3>
                🏕 Basecamp Outdoor
            </h3>

            <p>
                Penyedia perlengkapan outdoor
                untuk petualangan terbaikmu.
            </p>

        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
```
