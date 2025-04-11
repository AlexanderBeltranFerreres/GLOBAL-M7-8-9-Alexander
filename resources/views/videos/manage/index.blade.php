<x-layout>
    <div class="container">
        <h1>Gestió de Vídeos</h1>
        <!-- Botó destacat per crear vídeo -->
        <a href="{{ route('videos.manage.create') }}" class="btn btn-create-video mb-3">Crear Vídeo</a>

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <!-- Taula que ocupa tota l'amplada disponible -->
        <div class="table-responsive">
            <table class="table table-striped mt-3">
                <thead>
                <tr>
                    <th>Títol</th>
                    <th>Descripció</th>
                    <th>URL</th>
                    <th>Data de publicació</th>
                    <th>Anterior</th>
                    <th>Següent</th>
                    <th>Sèrie</th>
                    <th>Accions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($videos as $video)
                    <tr>
                        <td>{{ $video->title }}</td>
                        <td>{{ \Str::limit($video->description, 50) }}</td>
                        <td><a href="{{ $video->url }}" target="_blank">{{ $video->url }}</a></td>
                        <td>{{ \Carbon\Carbon::parse($video->published_at)->format('d-m-Y') }}</td>
                        <td>{{ $video->previous }}</td>
                        <td>{{ $video->next }}</td>
                        <td>{{ $video->series_id }}</td>
                        <td>
                            <a href="{{ route('videos.manage.edit', $video->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('videos.manage.destroy', $video->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-layout>
<!-- Estils CSS -->
<style>
    .container {
        padding: 3rem;
        background-color: #fefefe;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    h1 {
        font-size: 1.75rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 2rem;
    }

    .btn-create-video {
        background-color: #c5a880;
        color: white;
        font-size: 0.95rem;
        font-weight: 500;
        padding: 0.75rem 1.5rem;
        border-radius: 2rem;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-create-video:hover {
        background-color: #b8946c;
        transform: scale(1.05);
    }

    .alert {
        font-size: 0.875rem;
        padding: 0.75rem 1.25rem;
        background-color: #e6f4ea;
        color: #276749;
        border-left: 5px solid #38a169;
        border-radius: 0.375rem;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.95rem;
        background-color: white;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
    }

    .table th {
        background-color: #2d2d2d;
        color: #f5f5f5;
        font-weight: 600;
        text-align: left;
        padding: 1rem;
        white-space: nowrap;
    }

    .table td {
        padding: 1rem;
        color: #4b5563;
        vertical-align: middle;
        border-top: 1px solid #f3f4f6;
        white-space: nowrap;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #fafafa;
    }

    .table td a {
        color: #8c4a7d;
        text-decoration: none;
        font-weight: 500;
    }

    .table td a:hover {
        text-decoration: underline;
    }

    .btn-warning, .btn-danger {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        padding: 0.5rem 0.75rem;
        border-radius: 1.5rem;
        transition: all 0.3s ease;
    }

    .btn-warning {
        background-color: #f0ad4e;
        color: white;
    }

    .btn-warning:hover {
        background-color: #d08936;
    }

    .btn-danger {
        background-color: #e3342f;
        color: white;
    }

    .btn-danger:hover {
        background-color: #cc1f1a;
    }

    @media (max-width: 768px) {
        .table {
            font-size: 0.85rem;
        }

        .btn-create-video {
            width: 100%;
            display: block;
            margin-bottom: 1rem;
        }

        .btn-warning, .btn-danger {
            display: block;
            width: 100%;
            margin-bottom: 0.5rem;
        }
    }
</style>
