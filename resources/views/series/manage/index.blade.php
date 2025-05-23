<x-layout>
    <div class="container">
        <h1>Gestió de Sèries</h1>

        <!-- Botó destacat per crear sèrie -->
        <a href="{{ route('series.manage.create') }}" data-qa="create-series">
            <x-button variant="crear" class="mb-3">Crear Sèrie</x-button>
        </a>


    @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <!-- Taula de sèries -->
        <div class="table-responsive">
            <table class="table table-striped mt-3">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Títol</th>
                    <th>Descripció</th>
                    <th>Data de Publicació</th>
                    <th>Accions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($series as $serie)
                    <tr>
                        <td>{{ $serie->id }}</td>
                        <td>{{ $serie->title }}</td>
                        <td>{{ \Str::limit($serie->description, 50) }}</td>
                        <td>{{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d-m-Y') : 'No publicat' }}</td>
                        <td>
                            <!-- Botó Editar -->
                            <a href="{{ route('series.manage.edit', $serie) }}" data-qa="edit-series-{{ $serie->id }}">
                                <x-button variant="editar" size="sm">Editar</x-button>
                            </a>

                            <!-- Botó Eliminar -->
                            <form action="{{ route('series.manage.destroy', $serie) }}" method="POST" style="display:inline;" data-qa="delete-series-{{ $serie->id }}">
                                @csrf
                                @method('DELETE')
                                <x-button variant="borrar" type="submit" size="sm" onclick="return confirm('Estàs segur que vols eliminar aquesta sèrie? Els vídeos associats també seran desassignats.')">
                                    Eliminar
                                </x-button>
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
        padding: 40px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    h1 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }


    .alert {
        font-size: 14px;
        padding: 10px;
        background-color: #d4edda;
        color: #155724;
        border-radius: 5px;
    }

    .table {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-size: 14px;
        margin-top: 20px;
    }

    .table th {
        background-color: #0069d9;
        color: white;
        font-weight: 600;
        padding: 12px;
    }

    .table td {
        padding: 12px 15px;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .table td a {
        color: #0069d9;
        text-decoration: none;
    }

    .table td a:hover {
        text-decoration: underline;
    }

    .btn-warning, .btn-danger {
        font-size: 12px;
        padding: 6px 12px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .btn-warning {
        background-color: #ffc107;
        color: white;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    @media (max-width: 768px) {
        .table {
            font-size: 12px;
        }

        .btn-create-series, .btn-warning, .btn-danger {
            font-size: 12px;
            padding: 6px 12px;
        }

        .table td {
            padding: 10px 12px;
        }

        h1 {
            font-size: 20px;
        }
    }

    @media (max-width: 576px) {
        h1 {
            font-size: 18px;
        }

        .table td {
            padding: 8px 10px;
        }

        .btn-create-series {
            font-size: 14px;
            padding: 8px 16px;
        }

        .btn-warning, .btn-danger {
            font-size: 10px;
            padding: 5px 10px;
        }
    }
</style>
