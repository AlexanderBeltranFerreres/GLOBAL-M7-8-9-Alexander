<x-layout>
    <div class="container">
        <div class="row">
            @if (Auth::check())
                <div class="col-12 mb-3">
                    <a href="{{ route('videos.create') }}" class="btn btn-primary">Crear Vídeo</a>
                </div>
            @endif

            @foreach ($videos as $video)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card border-0 shadow-sm rounded" onclick="window.location='{{ route('videos.show', $video->id) }}'">
                        <!-- Miniatura com a imatge destacada -->
                        <iframe class="card-img-top" width="560" height="315" src="{{ $video->url }}?autoplay=0" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen style="pointer-events: none;"></iframe>

                        <!-- Títol i descripció -->
                        <div class="card-body p-2">
                            <h5 class="card-title text-truncate" style="font-size: 14px; font-weight: 600;">{{ $video->title }}</h5>
                            <p class="card-text text-truncate" style="font-size: 12px; color: #606060;">{{ \Str::limit($video->description, 60) }}</p>
                            <a href="{{ route('videos.show', $video->id) }}" class="btn btn-outline-primary btn-sm">Veure Detall</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-layout>
<!-- Estils CSS -->
<style>
    body {
        font-family: 'Inter', 'Helvetica Neue', sans-serif;
        background-color: #f5f5f5;
        color: #1f1f1f;
    }

    .container {
        padding: 4rem 2rem;
        background-color: #f9f9f9;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 2rem;
    }

    .col-lg-3,
    .col-md-4,
    .col-sm-6 {
        flex: 1 1 calc(25% - 2rem);
    }

    .card {
        background: #ffffff;
        border-radius: 1.25rem;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.08);
    }

    .card-img-top {
        height: 200px;
        width: 100%;
        object-fit: cover;
        border-bottom: 1px solid #e5e7eb;
        pointer-events: none;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 0.5rem;
    }

    .card-text {
        font-size: 0.95rem;
        color: #6b7280;
        line-height: 1.5;
        margin-bottom: 1rem;
    }

    .btn-outline-renaissance {
        display: inline-block;
        padding: 0.5rem 1rem;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        border: 2px solid #c5a880;
        color: #c5a880;
        border-radius: 9999px;
        background-color: transparent;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-outline-renaissance:hover {
        background-color: #c5a880;
        color: #ffffff;
    }

    /* Responsiu */
    @media (max-width: 1200px) {
        .col-lg-3 {
            flex: 1 1 calc(33.333% - 2rem);
        }
    }

    @media (max-width: 992px) {
        .col-md-4 {
            flex: 1 1 calc(50% - 2rem);
        }
    }

    @media (max-width: 768px) {
        .col-sm-6 {
            flex: 1 1 100%;
        }

        .card-img-top {
            height: 160px;
        }
    }
</style>
