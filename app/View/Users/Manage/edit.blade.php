@extends('layouts.app')

@section('content')
    @if(auth()->user()->can('manage-users'))
        <h1>Editar Usuari</h1>
        <table border="1">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
            </tbody>
        </table>
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="name" value="{{ $user->name }}" required>
            <input type="email" name="email" value="{{ $user->email }}" required>
            <input type="password" name="password" placeholder="Nova contrasenya">
            <input type="password" name="password_confirmation" placeholder="Confirma la contrasenya">
            <button type="submit">Actualitzar</button>
        </form>
    @endif
@endsection
