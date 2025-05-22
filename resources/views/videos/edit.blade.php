<x-layout>
    <div class="videos-container">
        <h1 class="video-title">Editar Vídeo</h1>

        <form action="{{ route('videos.update', $video->id) }}" method="POST" data-qa="video-edit-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Títol</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $video->title }}" required>
            </div>

            <div class="form-group">
                <label for="description">Descripció</label>
                <textarea id="description" name="description" class="form-control">{{ $video->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="url">URL</label>
                <input type="url" id="url" name="url" class="form-control" value="{{ $video->url }}" required>
            </div>

            <div class="form-group">
                <label for="published_at">Data de publicació</label>
                <input type="date" id="published_at" name="published_at" class="form-control"
                       value="{{ \Carbon\Carbon::parse($video->published_at)->format('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="previous">Vídeo anterior</label>
                <input type="text" id="previous" name="previous" class="form-control" value="{{ $video->previous }}">
            </div>

            <div class="form-group">
                <label for="next">Vídeo següent</label>
                <input type="text" id="next" name="next" class="form-control" value="{{ $video->next }}">
            </div>

            <div class="form-group">
                <label for="series_id">Sèrie</label>
                <select id="series_id" name="series_id" class="form-control">
                    <option value="">Selecciona una sèrie</option>
                    @foreach ($series as $serie)
                        <option value="{{ $serie->id }}" {{ $serie->id == $video->series_id ? 'selected' : '' }}>
                            {{ $serie->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="actions-row">
                <button type="submit" class="btn-main-action">Actualitzar Vídeo</button>
            </div>
        </form>
    </div>
</x-layout>
