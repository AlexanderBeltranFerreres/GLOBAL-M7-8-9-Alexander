<x-layout>
    <div class="max-w-7xl mx-auto p-6">

        <div class="flex justify-end mb-6">
            @if (Auth::check())
                <a href="{{ route('create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition">
                    Crear Vídeo
                </a>
            @endif
        </div>

        @if($videos->isEmpty())
            <p class="text-center text-gray-500 text-lg">No hi ha vídeos disponibles.</p>
        @else
            <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($videos as $video)
                    <div
                        class="bg-white rounded-lg shadow-md cursor-pointer hover:shadow-xl transition p-4 flex flex-col"
                        onclick="window.location='{{ route('videos.show', $video->id) }}'"
                        role="button"
                        tabindex="0"
                        onkeypress="if(event.key === 'Enter') window.location='{{ route('videos.show', $video->id) }}'"
                    >
                        <div class="aspect-w-16 aspect-h-9 mb-4 rounded overflow-hidden">
                            <iframe
                                src="{{ $video->url }}?autoplay=0"
                                title="YouTube video player"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                                class="w-full h-full"
                                referrerpolicy="strict-origin-when-cross-origin"
                            ></iframe>
                        </div>

                        <div class="flex flex-col flex-grow">
                            <h5 class="font-semibold text-lg mb-1 truncate" title="{{ $video->title }}">{{ $video->title }}</h5>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3" title="{{ $video->description }}">{{ \Str::limit($video->description, 60) }}</p>

                            <a href="{{ route('videos.show', $video->id) }}"
                               class="mt-auto inline-block self-start bg-transparent border border-blue-600 text-blue-600 font-semibold py-1 px-3 rounded hover:bg-blue-600 hover:text-white transition text-sm">
                                Veure Detall
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-layout>
