<x-layout>
    <div class="max-w-7xl mx-auto p-6">

        <h1 class="text-4xl font-extrabold mb-8 text-center text-gray-800">Gestió de Vídeos</h1>

        <a href="{{ route('videos.manage.create') }}">
            <x-button variant="crear" class="mb-8">
                Crear Vídeo
            </x-button>
        </a>

        @if(session('success'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 4000)"
                x-show="show"
                x-transition
                class="mb-6 p-4 bg-green-100 text-green-800 rounded-md shadow"
            >
                {{ session('success') }}
            </div>
        @endif

        @if($videos->isEmpty())
            <p class="text-center text-gray-500 text-lg">No hi ha vídeos per mostrar.</p>
        @else

            <!-- TAULA VISIBLE A ESCRIPTORI -->
            <div class="hidden md:block overflow-x-auto rounded-lg shadow-md">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Títol</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripció</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anterior</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Següent</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sèrie</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Accions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($videos as $video)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $video->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ \Str::limit($video->description, 50) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ $video->url }}" target="_blank" class="text-blue-600 hover:underline">Link</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($video->published_at)->format('d-m-Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($video->previous)
                                    <a href="{{ $video->previous }}" target="_blank" class="text-blue-600 hover:underline">Link</a>
                                    @else
                                        &mdash;
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($video->next)
                                    <a href="{{ $video->next }}" target="_blank" class="text-blue-600 hover:underline">Link</a>
                                    @else
                                        &mdash;
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $video->series_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                <x-button variant="editar" href="{{ route('videos.manage.edit', $video->id) }}" class="px-3 py-1 text-sm inline-block">
                                    Editar
                                </x-button>

                                <form action="{{ route('videos.manage.destroy', $video->id) }}" method="POST" class="inline" onsubmit="return confirm('Segur que vols eliminar aquest vídeo?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <x-button variant="borrar" type="submit" class="px-3 py-1 text-sm inline-block">
                                        Eliminar
                                    </x-button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- LISTA MOBILE AMB CARDS -->
            <div class="md:hidden space-y-6">
                @foreach($videos as $video)
                    <div class="bg-white shadow-lg rounded-lg p-4">
                        <h2 class="text-xl font-semibold mb-2">{{ $video->title }}</h2>
                        <p class="mb-2 text-gray-700">{{ \Str::limit($video->description, 100) }}</p>
                        <p class="mb-2">
                            <a href="{{ $video->url }}" target="_blank" class="text-blue-600 hover:underline">Link</a>
                        </p>
                        <p class="text-sm text-gray-500 mb-1"><strong>Data:</strong> {{ \Carbon\Carbon::parse($video->published_at)->format('d-m-Y') }}</p>
                        <p class="text-sm text-gray-500 mb-1">
                            <strong>Anterior:</strong>
                            @if($video->previous)
                                <a href="{{ $video->previous }}" target="_blank" class="text-blue-600 hover:underline">Link</a>
                                @else
                                    &mdash;
                            @endif
                        </p>
                        <p class="text-sm text-gray-500 mb-1">
                            <strong>Següent:</strong>
                            @if($video->next)
                                <a href="{{ $video->next }}" target="_blank" class="text-blue-600 hover:underline">Link</a>
                                @else
                                    &mdash;
                            @endif
                        </p>
                        <p class="text-sm text-gray-500 mb-4"><strong>Sèrie:</strong> {{ $video->series_id }}</p>

                        <div class="flex space-x-3">
                            <x-button variant="editar" href="{{ route('videos.manage.edit', $video->id) }}" class="flex-1 w-full text-center">
                                Editar
                            </x-button>

                            <form action="{{ route('videos.manage.destroy', $video->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Segur que vols eliminar aquest vídeo?');">
                                @csrf
                                @method('DELETE')
                                <x-button variant="borrar" type="submit" class="w-full">
                                    Eliminar
                                </x-button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>

        @endif
    </div>
</x-layout>
