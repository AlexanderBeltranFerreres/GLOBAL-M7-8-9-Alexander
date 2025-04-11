<x-layout>
    <div class="container">
        <h1>Editar Vídeo</h1>

        <form action="{{ route('videos.manage.update', $video->id) }}" method="POST" data-qa="video-edit-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Títol</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $video->title }}" required>
            </div>

            <div class="form-group">
                <label for="description">Descripció</label>
                <textarea class="form-control" id="description" name="description">{{ $video->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="url">URL</label>
                <input type="url" class="form-control" id="url" name="url" value="{{ $video->url }}" required>
            </div>

            <div class="form-group">
                <label for="published_at">Data de publicació</label>
                <input type="date" class="form-control" id="published_at" name="published_at" value="{{ \Carbon\Carbon::parse($video->published_at)->format('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="previous">Vídeo anterior</label>
                <input type="text" class="form-control" id="previous" name="previous" value="{{ $video->previous }}">
            </div>

            <div class="form-group">
                <label for="next">Vídeo següent</label>
                <input type="text" class="form-control" id="next" name="next" value="{{ $video->next }}">
            </div>

            <div class="form-group">
                <label for="series_id">Sèrie</label>
                <input type="number" class="form-control" id="series_id" name="series_id" value="{{ $video->series_id }}">
            </div>

            <button type="submit" class="btn btn-edit-video mt-3">Actualitzar Vídeo</button>
        </form>
    </div>

</x-layout>
<!-- Estils CSS -->
<style>
    .container {
        max-width: 700px;
        margin: auto;
        padding: 3rem;
        background-color: #fffefc;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
    }

    h1 {
        font-size: 2rem;
        font-weight: 600;
        color: #4b2e2e;
        margin-bottom: 2rem;
        text-align: center;
        font-family: 'Georgia', serif;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-size: 0.95rem;
        font-weight: 600;
        color: #3e3e3e;
        margin-bottom: 0.5rem;
    }

    .form-control {
        width: 100%;
        font-size: 0.95rem;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        border: 1px solid #ddd;
        background-color: #fffaf3;
        transition: all 0.2s ease-in-out;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.03);
    }

    .form-control:focus {
        border-color: #f4a261;
        outline: none;
        box-shadow: 0 0 0 3px rgba(244, 162, 97, 0.25);
    }

    .btn-edit-video {
        display: inline-block;
        background-color: #ffb703;
        color: #fff;
        font-size: 1rem;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        letter-spacing: 0.5px;
    }

    .btn-edit-video:hover {
        background-color: #f4a261;
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .container {
            padding: 2rem;
        }

        .btn-edit-video {
            width: 100%;
            padding: 0.75rem;
            font-size: 0.95rem;
        }

        .form-control {
            font-size: 0.85rem;
        }
    }
</style>
