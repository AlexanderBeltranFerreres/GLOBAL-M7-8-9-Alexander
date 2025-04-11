<x-layout>
    <div class="container">
        <h1>Confirmar Eliminació</h1>

        <p>Estàs segur que vols eliminar el vídeo: <strong>{{ $video->title }}</strong>?</p>

        <form action="{{ route('videos.manage.destroy', $video->id) }}" method="POST" data-qa="video-delete-form">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">Eliminar</button>
            <a href="{{ route('videos.manage.index') }}" class="btn btn-secondary">Cancel·lar</a>
        </form>
    </div>

</x-layout>
<!-- Estils CSS -->
<style>
    .container {
        padding: 60px;
        background-color: #f9f9f9;
        border-radius: 12px;
        box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 28px;
        font-weight: 700;
        color: #3e3e3e;
        margin-bottom: 20px;
        text-align: center;
    }

    p {
        font-size: 16px;
        color: #333;
        margin-bottom: 30px;
        text-align: center;
    }

    strong {
        font-weight: 700;
        color: #8c4a7d;
    }

    /* Estil per al botó d'eliminació */
    .btn-danger {
        background-color: #e3342f;
        color: white;
        font-size: 16px;
        font-weight: 700;
        padding: 12px 20px;
        border-radius: 8px;
        border: none;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c53030;
        transform: scale(1.05);
    }

    /* Estil per al botó de cancel·lació */
    .btn-secondary {
        background-color: #6c757d;
        color: white;
        font-size: 16px;
        font-weight: 700;
        padding: 12px 20px;
        border-radius: 8px;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    /* Mida màxima per a dispositius més petits */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        .btn-danger, .btn-secondary {
            font-size: 14px;
            padding: 10px 15px;
        }
    }
</style>
