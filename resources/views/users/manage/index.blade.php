<x-layout>
    <div class="container">
        <h1>Gestió d'Usuaris</h1>

        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <x-button variant="crear" href="{{ route('users.manage.create') }}" class="mb-3">
            Crear Usuari
        </x-button>


        <!-- Taula que ocupa tota l'amplada disponible -->
        <div class="table-responsive">
            <table class="table table-striped mt-3">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Accions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <x-button variant="editar" href="{{ route('users.manage.edit', $user) }}" class="btn-sm px-3 py-1">
                                Editar
                            </x-button>

                            <form action="{{ route('users.manage.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Estàs segur?')">
                                @csrf
                                @method('DELETE')
                                <x-button variant="borrar" type="submit" class="btn-sm px-3 py-1">
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
    }

    /* Taula i estil de les cel·les */
    .table {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-size: 14px;
    }

    .table th {
        background-color: #0069d9;
        color: white;
        font-weight: 600;
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



    /* Estil per fer la taula més responsive */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    @media (max-width: 768px) {
        .table {
            font-size: 12px;
        }
        .btn-primary, .btn-warning, .btn-danger {
            font-size: 12px;
            padding: 6px 12px;
        }
    }
</style>

