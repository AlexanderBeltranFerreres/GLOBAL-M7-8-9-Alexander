<x-layout>
    <div class="container videos-container">
        <div class="actions-row">
            @if (Auth::check())
                <div class="action-create-video">
                    <a href="{{ route('create') }}" class="btn btn-primary btn-main-action">Crear Vídeo</a>
                </div>
            @endif
        </div>

        <div class="videos-grid">
            @forelse ($videos as $video)
                <div class="video-card" onclick="window.location='{{ route('videos.show', $video->id) }}'">
                    <iframe class="video-iframe" width="560" height="315" src="{{ $video->url }}?autoplay=0"
                            title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                    <div class="video-info">
                        <h5 class="video-title text-truncate">{{ $video->title }}</h5>
                        <p class="video-description text-truncate">{{ \Str::limit($video->description, 60) }}</p>
                        <a href="{{ route('videos.show', $video->id) }}" class="btn btn-outline-primary btn-sm btn-detail">Veure Detall</a>
                    </div>
                </div>
            @empty
                <p class="no-videos-msg">No hi ha vídeos disponibles.</p>
            @endforelse
        </div>
    </div>
</x-layout>
