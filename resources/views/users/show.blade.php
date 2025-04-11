<x-layout>

    <div class="container">
        <h1>Detall de l'Usuari</h1>

        <div class="card user-info-card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            </div>
        </div>

        <h2 class="mt-4">Vídeos de l'Usuari</h2>

        @if($user->videos->count() > 0)
            <div class="videos-list">
                @foreach($user->videos as $video)
                    <div class="video-card">
                        <div class="video-iframe">
                            <iframe src="{{ $video->url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="video-info">
                            <h5 class="video-title">{{ $video->title }}</h5>
                            <p class="video-description">{{ Str::limit($video->description, 100) }}...</p>
                            <p class="video-date"><strong>Publicat el:</strong> {{ $video->published_at }}</p>
                            <a href="{{ route('videos.show', $video->id) }}" class="btn btn-info btn-sm">Veure Detall</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>L'usuari no té vídeos.</p>
        @endif
    </div>

</x-layout>
<!-- Estils CSS -->
<style>
    .container {
        padding: 50px;
        background-color: #fdfaf6;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        max-width: 1100px;
        margin: auto;
    }

    h1, h2 {
        font-family: 'Georgia', serif;
        font-weight: 800;
        color: #4a2c2a;
        margin-bottom: 28px;
        letter-spacing: 0.5px;
    }

    h1 {
        font-size: 30px;
        text-align: center;
    }

    h2 {
        font-size: 24px;
        margin-top: 40px;
    }

    .user-info-card {
        background-color: #fff8f2;
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
        border-radius: 12px;
        padding: 24px;
        border: none;
    }

    .card-title {
        font-size: 20px;
        font-weight: 700;
        color: #3e3e3e;
    }

    .card-text {
        font-size: 16px;
        color: #555;
        margin-top: 10px;
    }

    .videos-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }

    .video-card {
        background-color: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease;
        border: 1px solid #eee;
    }

    .video-card:hover {
        transform: translateY(-5px);
    }

    .video-iframe {
        width: 100%;
        height: 200px;
        border-bottom: 1px solid #eee;
    }

    .video-iframe iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    .video-info {
        padding: 16px;
    }

    .video-title {
        font-size: 18px;
        font-weight: 700;
        color: #4a2c2a;
        margin-bottom: 8px;
    }

    .video-description {
        font-size: 14px;
        color: #666;
        margin-bottom: 8px;
    }

    .video-date {
        font-size: 13px;
        color: #999;
        margin-bottom: 10px;
    }

    .btn-info {
        background-color: #d88b61;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-info:hover {
        background-color: #bb6b44;
        transform: scale(1.03);
    }

    @media (max-width: 768px) {
        .container {
            padding: 24px;
        }

        h1 {
            font-size: 26px;
        }

        h2 {
            font-size: 20px;
        }

        .video-iframe {
            height: 180px;
        }

        .video-info {
            text-align: center;
        }

        .btn-info {
            width: 100%;
            padding: 10px 0;
            font-size: 13px;
        }
    }
</style>

