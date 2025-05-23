<x-layout>
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-lg mt-10">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-10 font-serif">Editar Vídeo</h1>

        <form action="{{ route('videos.manage.update', $video->id) }}" method="POST" data-qa="video-edit-form" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-gray-700 font-semibold mb-1">Títol</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ $video->title }}"
                    required
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
                >
            </div>

            <div>
                <label for="description" class="block text-gray-700 font-semibold mb-1">Descripció</label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
                >{{ $video->description }}</textarea>
            </div>

            <div>
                <label for="url" class="block text-gray-700 font-semibold mb-1">URL</label>
                <input
                    type="url"
                    id="url"
                    name="url"
                    value="{{ $video->url }}"
                    required
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
                >
            </div>

            <div>
                <label for="published_at" class="block text-gray-700 font-semibold mb-1">Data de publicació</label>
                <input
                    type="date"
                    id="published_at"
                    name="published_at"
                    value="{{ \Carbon\Carbon::parse($video->published_at)->format('Y-m-d') }}"
                    required
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
                >
            </div>

            <div>
                <label for="previous" class="block text-gray-700 font-semibold mb-1">Vídeo anterior</label>
                <input
                    type="text"
                    id="previous"
                    name="previous"
                    value="{{ $video->previous }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
                >
            </div>

            <div>
                <label for="next" class="block text-gray-700 font-semibold mb-1">Vídeo següent</label>
                <input
                    type="text"
                    id="next"
                    name="next"
                    value="{{ $video->next }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
                >
            </div>

            <div>
                <label for="series_id" class="block text-gray-700 font-semibold mb-1">Sèrie</label>
                <input
                    type="number"
                    id="series_id"
                    name="series_id"
                    value="{{ $video->series_id }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
                >
            </div>

            <button
                type="submit"
                class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 rounded-xl shadow-md transition transform hover:scale-105"
            >
                Actualitzar Vídeo
            </button>
        </form>
    </div>
</x-layout>
