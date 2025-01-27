<x-layout>
    <div class="video-container max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="video-title text-3xl font-bold text-gray-800 mb-4">Títol: {{ $video['title'] }}</h1>
        <p class="video-description text-gray-700 mb-6">Descripció: {{ $video['description'] }}</p>

        <div class="video-frame aspect-w-16 aspect-h-9 mb-6">
            <iframe
                src="{{ $video['url'] }}"
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
