<x-layout>
    <div class="videos-container">
        <h1 class="video-title">Crear Vídeo</h1>

        <form action="{{ route('videos.store') }}" method="POST" data-qa="video-create-form">
            @csrf

            <div class="form-group">
                <label for="title">Títol</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="description">Descripció</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>

            <div class="form-group">
                <label for="url">URL</label>
                <input type="url" class="form-control" id="url" name="url" required>
            </div>

            <div class="form-group">
                <label for="published_at">Data de publicació</label>
                <input type="date" class="form-control" id="published_at" name="published_at" required>
            </div>

            <div class="form-group">
                <label for="previous">Vídeo anterior</label>
                <input type="text" class="form-control" id="previous" name="previous">
            </div>

            <div class="form-group">
                <label for="next">Vídeo següent</label>
                <input type="text" class="form-control" id="next" name="next">
            </div>

            <div class="form-group">
                <label for="series_id">Sèrie</label>
                <select class="form-control" id="series_id" name="series_id">
                    <option value="">Selecciona una sèrie</option>
                    @foreach ($series as $serie)
                        <option value="{{ $serie->id }}">{{ $serie->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="actions-row">
                <x-button variant="crear" type="submit">
                    Crear Vídeo
                </x-button>
            </div>
        </form>
    </div>
</x-layout>
