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

            <button type="submit" class="btn btn-create-video mt-3">Crear Vídeo</button>
        </form>
    </div>

    <!-- Estils CSS -->
    <style>
        .container {
            padding: 60px;
            background-color: #f9f9f9;
            border-radius: 12px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 26px;
            font-weight: 700;
            color: #3e3e3e;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Estil per als inputs i formularis */
        .form-group {
            margin-bottom: 25px;
        }

        .form-control {
            font-size: 15px;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            background-color: #fff;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #8c4a7d;
            background-color: #fff;
        }

        /* Estil per al botó de crear vídeo */
        .btn-create-video {
            background-color: #8c4a7d;
            color: white;
            font-size: 16px;
            font-weight: 700;
            padding: 14px 22px;
            border-radius: 8px;
            border: none;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .btn-create-video:hover {
            background-color: #6b2c55;
            transform: scale(1.05);
        }

        /* Estils per la taula i elements del formulari */
        .form-group label {
            font-weight: 600;
            font-size: 15px;
            color: #3e3e3e;
            margin-bottom: 10px;
        }

        .btn-success {
            background-color: #8c4a7d;
            color: white;
            font-weight: 700;
            padding: 12px 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #6b2c55;
        }

        /* Mida màxima per a dispositius més petits */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .btn-create-video, .btn-success {
                font-size: 14px;
                padding: 10px 15px;
            }

            .form-control {
                font-size: 13px;
                padding: 10px;
            }
        }
    </style>
</x-layout>
