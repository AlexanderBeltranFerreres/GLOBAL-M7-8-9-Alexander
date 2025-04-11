<x-layout>
    <div class="container py-5">
        <!-- Títol de la sèrie -->
        <h1 class="mb-4 text-center fw-bold">{{ $serie->title }}</h1>

        <!-- Descripció de la sèrie -->
        <div class="mb-4 text-center">
            <p class="text-secondary fs-5">{{ $serie->description }}</p>
        </div>

        <!-- Detalls -->
        <div class="d-flex flex-wrap justify-content-center gap-4 mb-5 text-muted small">
            <div>
                <strong>Publicada el:</strong>
                {{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d/m/Y') : 'No especificada' }}
            </div>
            @if($serie->user_name)
                <div class="d-flex align-items-center gap-2">
                    @if($serie->user_photo_url)
                        <img src="{{ $serie->user_photo_url }}" alt="Usuari"
                             class="rounded-circle" width="28" height="28" style="object-fit: cover;">
                    @endif
                    <span><strong>Creada per:</strong> {{ $serie->user_name }}</span>
                </div>
            @endif
        </div>

        <!-- Missatge d'èxit -->
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <!-- Vídeos associats -->
        <h3 class="mb-4 fw-semibold">Vídeos associats</h3>

        @if($videos->isEmpty())
            <p class="text-muted">No hi ha vídeos associats a aquesta sèrie.</p>
        @else
            <div class="row">
                @foreach($videos as $video)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 shadow-sm border-0 rounded overflow-hidden"
                             onclick="window.location='{{ route('videos.show', $video->id) }}'"
                             style="cursor: pointer; transition: transform 0.3s;">
                            <div class="ratio ratio-16x9">
                                <iframe
                                    src="{{ $video->url }}?autoplay=0"
                                    title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen
                                    style="pointer-events: none;">
                                </iframe>
                            </div>

                            <div class="card-body p-3">
                                <h5 class="card-title text-truncate fw-bold mb-1" style="font-size: 15px;">
                                    {{ $video->title }}
                                </h5>
                                <p class="card-text text-truncate text-secondary mb-2" style="font-size: 13px;">
                                    {{ \Str::limit($video->description, 60) }}
                                </p>
                                <p class="text-muted mb-2 small">
                                    Publicat el: {{ $video->created_at->format('d/m/Y') }}
                                </p>
                                <a href="{{ route('videos.show', $video) }}" class="btn btn-sm btn-outline-primary w-100">
                                    Veure Detalls
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Botó de tornada -->
        <div class="mt-4 text-center">
            <a href="{{ route('series.index') }}" class="btn btn-secondary">
                ← Tornar a les Sèries
            </a>
        </div>
    </div>
</x-layout>
<style>
    .container {
        padding: 40px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    h1 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }

    .text-center {
        text-align: center;
    }

    .text-muted {
        color: #6c757d;
    }

    .text-secondary {
        color: #6c757d;
    }

    .text-truncate {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .fw-bold {
        font-weight: 600;
    }

    .btn-secondary, .btn-outline-primary {
        background-color: #f8f9fa;
        color: #007bff;
        font-weight: 600;
        padding: 12px 20px;
        border-radius: 5px;
        border: 1px solid #007bff;
        transition: background-color 0.3s, transform 0.3s;
    }

    .btn-secondary:hover, .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
        transform: scale(1.05);
    }

    /* Estils per a la taula i les cartes */
    .card {
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 16px;
    }

    .card-title {
        font-size: 16px;
        font-weight: 600;
    }

    .card-text {
        font-size: 14px;
        color: #6c757d;
    }

    .ratio-16x9 {
        position: relative;
        padding-bottom: 56.25%; /* Aspect ratio de 16:9 */
        height: 0;
        overflow: hidden;
        max-width: 100%;
    }

    .ratio-16x9 iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    /* Estils per als vídeos associats */
    .col-lg-3, .col-md-4, .col-sm-6 {
        padding: 10px;
    }

    .d-flex {
        display: flex;
    }

    .gap-2 {
        gap: 0.5rem;
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }

    .small {
        font-size: 12px;
    }

    .mt-4 {
        margin-top: 1.5rem;
    }

    .btn-create-user, .btn-update {
        background-color: #007bff;
        color: white;
        font-size: 16px;
        font-weight: 600;
        padding: 12px 20px;
        border-radius: 5px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .btn-create-user:hover, .btn-update:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .alert {
        font-size: 14px;
        padding: 10px;
        background-color: #d4edda;
        color: #155724;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    /* Estils per la foto de l'usuari */
    .rounded-circle {
        border-radius: 50%;
    }

    .ratio-16x9 iframe {
        pointer-events: none;
    }

    /* Estils per fer la taula més responsive */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }
</style>
