<x-layout>
    <div class="video-container max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="video-title text-3xl font-bold text-gray-800 mb-4">Títol: {{ $video['title'] }}</h1>
        <p class="video-description text-gray-700 mb-6">Descripció: {{ $video['description'] }}</p>

        <div class="video-frame aspect-w-16 aspect-h-9 mb-6">
            <iframe
                src="{{ $video['embed_url'] }}"
                width="800"
                height="450"
                class="w-full h-full border rounded-lg"
                allowfullscreen
            ></iframe>
        </div>

        <a
            href="{{ $video['url'] }}"
            target="_blank"
            class="video-link inline-block bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition"
        >
            MIRA EL VÍDEO DESDE LA FONT
        </a>

        <ul class="video-info mt-6 space-y-2 text-gray-600">
            <li>Data de publicació: <span class="font-medium">{{ $video['published_at'] }}</span></li>
            <li>Anterior vídeo: <span class="font-medium">{{ $video['previous'] }}</span></li>
            <li>Següent vídeo: <span class="font-medium">{{ $video['next'] }}</span></li>
        </ul>
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
