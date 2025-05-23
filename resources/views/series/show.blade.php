<x-layout>
    <div class="max-w-6xl mx-auto bg-gray-50 rounded-lg p-10 my-10">
        <!-- Títol de la sèrie -->
        <h1 class="text-3xl font-semibold text-center mb-6">{{ $serie->title }}</h1>

        <!-- Descripció -->
        <p class="text-center text-gray-600 text-lg mb-10">{{ $serie->description }}</p>

        <!-- Detalls -->
        <div class="flex flex-wrap justify-center gap-8 mb-10 text-gray-500 text-sm">
            <div>
                <span class="font-semibold text-gray-700">Publicada el:</span>
                {{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d/m/Y') : 'No especificada' }}
            </div>

            @if($serie->user_name)
                <div class="flex items-center gap-3">
                    @if($serie->user_photo_url)
                        <img src="{{ $serie->user_photo_url }}" alt="Usuari" class="w-7 h-7 rounded-full object-cover" />
                    @endif
                    <span><span class="font-semibold text-gray-700">Creada per:</span> {{ $serie->user_name }}</span>
                </div>
            @endif
        </div>

        <!-- Missatge d'èxit -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 text-center py-2 rounded mb-8">
                {{ session('success') }}
            </div>
        @endif

        <!-- Vídeos associats -->
        <h3 class="text-xl font-semibold mb-6">Vídeos associats</h3>

        @if($videos->isEmpty())
            <p class="text-center text-gray-400">No hi ha vídeos associats a aquesta sèrie.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($videos as $video)
                    <div
                        class="bg-white rounded-lg shadow cursor-pointer hover:shadow-lg transition transform hover:-translate-y-1"
                        onclick="window.location='{{ route('videos.show', $video->id) }}'"
                    >
                        <div class="aspect-w-16 aspect-h-9 overflow-hidden rounded-t-lg">
                            <iframe
                                src="{{ $video->url }}?autoplay=0"
                                title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                                class="w-full h-full pointer-events-none"
                            ></iframe>
                        </div>

                        <div class="p-4">
                            <h5 class="font-semibold text-gray-800 truncate text-sm mb-1">{{ $video->title }}</h5>
                            <p class="text-gray-500 truncate text-xs mb-2">{{ \Str::limit($video->description, 60) }}</p>
                            <p class="text-gray-400 text-xs mb-3">Publicat el: {{ $video->created_at->format('d/m/Y') }}</p>
                            <a
                                href="{{ route('videos.show', $video) }}"
                                class="block text-center text-blue-600 border border-blue-600 rounded py-1 text-sm font-semibold hover:bg-blue-600 hover:text-white transition"
                            >
                                Veure Detalls
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Botó de tornada -->
        <div class="mt-10 text-center">
            <a
                href="{{ route('series.index') }}"
                class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold py-2 px-6 rounded transition"
            >
                ← Tornar a les Sèries
            </a>
        </div>
    </div>
</x-layout>
