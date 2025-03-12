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

    <!-- Estils CSS -->
    <style>
        .container {
            padding: 40px;
            background-color: #f8f7f4;
            border-radius: 12px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 28px;
            font-weight: 700;
            color: #5a3e36;
            margin-bottom: 20px;
            text-align: center;
            font-family: 'Georgia', serif;
        }

        .form-group label {
            font-weight: 600;
            font-size: 14px;
            color: #3e3e3e;
            margin-bottom: 8px;
        }

        .form-control {
            font-size: 14px;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease;
            background-color: #fff3e0;
        }

        .form-control:focus {
            border-color: #ff7043;
        }

        .btn-edit-video {
            background-color: #ffcc00;
            color: white;
            font-size: 16px;
            font-weight: 700;
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .btn-edit-video:hover {
            background-color: #ffb300;
            transform: scale(1.05);
        }

        /* Estils responsius */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .btn-edit-video {
                font-size: 14px;
                padding: 10px 15px;
            }

            .form-control {
                font-size: 12px;
                padding: 10px;
            }
        }
    </style>
</x-layout>
