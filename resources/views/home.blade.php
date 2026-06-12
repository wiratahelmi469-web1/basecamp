<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Basecamp Outdoor Blog</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">
            🏕️ Basecamp Outdoor
        </a>
    </div>
</nav>

<section class="bg-dark text-white py-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">
            Blog Basecamp Outdoor
        </h1>

        <p class="lead">
            Tips Camping, Hiking, Pendakian dan Outdoor Adventure
        </p>
    </div>
</section>

<div class="container py-5">

    <div class="row">

        @forelse($posts as $post)

            <div class="col-md-4 mb-4">

                <div class="card h-100 shadow-sm">

                    @if($post->thumbnail)
                        <img
                            src="{{ asset('storage/' . $post->thumbnail) }}"
                            class="card-img-top"
                            style="height:220px; object-fit:cover;"
                        >
                    @endif

                    <div class="card-body">

                        <h5 class="card-title">
                            {{ $post->title }}
                        </h5>

                        <p class="text-muted small">
                            {{ $post->published_at?->format('d M Y') }}
                        </p>

                        <p class="card-text">
                            {{ $post->excerpt }}
                        </p>

                        <a href="#" class="btn btn-success">
                            Baca Artikel
                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">
                <div class="alert alert-warning">
                    Belum ada artikel.
                </div>
            </div>

        @endforelse

    </div>

</div>

<footer class="bg-light py-4">
    <div class="container text-center">
        © {{ date('Y') }} Basecamp Outdoor
    </div>
</footer>

</body>
</html>
