@extends('layouts.app')

@section('content')
    @if(auth()->user()->can('manage-users'))
        <h1>Llista d'usuaris</h1>
        <a href="{{ route('users.create') }}">Crear usuari</a>
        <table border="1">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Accions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}">Editar</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
