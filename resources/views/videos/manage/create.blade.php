<x-layout>
    <div class="container">
        <h1>Crear Vídeo</h1>

        <form action="{{ route('videos.manage.store') }}" method="POST" data-qa="video-create-form">
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
                <input type="number" class="form-control" id="series_id" name="series_id">
            </div>

            <x-button variant="crear" type="submit" class="btn btn-create-video mt-3">Crear Vídeo</x-button>
        </form>
    </div>

</x-layout>
<!-- Estils CSS -->
<style>
    .container {
        padding: 60px;
        background-color: #fdfaf6;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        max-width: 800px;
        margin: auto;
    }

    h1 {
        font-size: 30px;
        font-weight: 800;
        color: #4a2c2a;
        margin-bottom: 40px;
        text-align: center;
        font-family: 'Georgia', serif;
        letter-spacing: 0.5px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        font-size: 15px;
        color: #333;
        margin-bottom: 10px;
    }

    .form-control {
        width: 100%;
        font-size: 15px;
        padding: 12px 14px;
        border-radius: 8px;
        border: 1px solid #ccc;
        background-color: #fff8f2;
        transition: all 0.3s ease;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .form-control:focus {
        border-color: #d88b61;
        background-color: #fffefc;
        outline: none;
        box-shadow: 0 0 0 2px rgba(255, 138, 101, 0.2);
    }

    .btn-success {
        background-color: #8c4a7d;
        color: white;
        font-weight: 700;
        padding: 12px 20px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
        border: none;
    }

    .btn-success:hover {
        background-color: #6b2c55;
    }

    @media (max-width: 768px) {
        .container {
            padding: 24px;
        }

        h1 {
            font-size: 24px;
        }

        .form-control {
            font-size: 14px;
            padding: 10px 12px;
        }

        .btn-create-video,
        .btn-success {
            font-size: 14px;
            padding: 10px 16px;
        }
    }
</style>

