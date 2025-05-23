<x-layout>
    <div class="container videos-container">
        <div class="video-card">
            <div class="video-iframe">
                <iframe
                    src="{{ $video['url'] }}"
                    width="100%"
                    height="200"
                    frameborder="0"
                    allowfullscreen
                ></iframe>
            </div>
            <div class="video-info">
                <h1 class="video-title">Títol: {{ $video['title'] }}</h1>
                <p class="video-description">Descripció: {{ $video['description'] }}</p>
                <ul class="video-info">
                    <li><strong>Data de publicació:</strong> {{ $video['published_at'] }}</li>
                    <li><strong>Anterior vídeo:</strong> {{ $video['previous'] ?? 'N/A' }}</li>
                    <li><strong>Següent vídeo:</strong> {{ $video['next'] ?? 'N/A' }}</li>
                    <li><strong>ID de la sèrie:</strong> {{ $video['series_id'] }}</li>
                    <li><strong>Usuari:</strong> {{ $video['user_id'] }}</li>
                </ul>
                <a href="{{ $video['url'] }}" target="_blank" class="btn-main-action mt-4 inline-block">
                    Mira el vídeo en una nova finestra
                </a>

                @if (auth()->user() && auth()->user()->id == $video['user_id'])
                    <div class="actions-row mt-4 space-x-3">
                        <x-button variant="editar" href="{{ route('videos.manage.edit', $video['id']) }}">
                            Editar
                        </x-button>

                        <form action="{{ route('videos.manage.destroy', $video['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('Segur que vols eliminar aquest vídeo?');">
                            @csrf
                            @method('DELETE')
                            <x-button variant="borrar" type="submit">
                                Eliminar
                            </x-button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
