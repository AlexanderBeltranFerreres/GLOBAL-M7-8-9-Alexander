<x-layout>
    <div class="video-container">
        <h1 class="video-title">Títol: {{ $video['title'] }}</h1>
        <p class="video-description">Descripció: {{ $video['description'] }}</p>
        <div class="video-frame">
            <iframe
                src="{{ $video['url'] }}"
                width="800"
                height="450"
                frameborder="0"
                allowfullscreen>
            </iframe>
        </div>
        <a href="{{ $video['url'] }}" target="_blank" class="video-link">Mira el vídeo en una nova finestra</a>
        <ul class="video-info">
            <li>Data de publicació: {{ $video['published_at'] }}</li>
            <li>Anterior vídeo: {{ $video['previous'] }}</li>
            <li>Següent vídeo: {{ $video['next'] }}</li>
            <li>ID de la sèrie: {{ $video['series_id'] }}</li>
            <li>Usuari: {{ $video['user_id'] }}</li>
        </ul>
        @if (auth()->user() && auth()->user()->id == $video['user_id'])
            <div class="video-actions">
                <a href="{{ route('videos.edit', $video['id']) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('videos.destroy', $video['id']) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        @endif
    </div>
</x-layout>
<style>
    body {
        font-family: 'Inter', 'Segoe UI', sans-serif;
        background-color: #f9f9f9;
        color: #333;
    }

    .video-container {
        background-color: #ffffff;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
        border-radius: 1.5rem;
        padding: 3rem;
        transition: box-shadow 0.3s ease;
    }

    .video-container:hover {
        box-shadow: 0 30px 70px rgba(0, 0, 0, 0.08);
    }

    .video-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 1.5rem;
    }

    .video-description {
        font-size: 1.125rem;
        line-height: 1.75;
        color: #4a5568;
        margin-bottom: 2rem;
    }

    .video-frame iframe {
        border-radius: 1rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    .video-link {
        background-color: #111827;
        color: #fff;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        border-radius: 0.75rem;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .video-link:hover {
        background-color: #1f2937;
        transform: translateY(-2px);
    }

    .video-info {
        margin-top: 2rem;
        font-size: 1rem;
        color: #4b5563;
    }

    .video-info li {
        margin-bottom: 0.5rem;
    }

    .video-info .font-medium {
        font-weight: 500;
        color: #111827;
    }
</style>
