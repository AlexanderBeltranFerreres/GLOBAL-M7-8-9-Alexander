@extends('layouts.app')

@section('content')
    @if(auth()->user()->can('manage-users'))
        <h1>Eliminar Usuari</h1>
        <p>Segur que vols eliminar {{ $user->name }}?</p>
        <p>Aquesta acció no es pot desfer.</p>
        <form action="{{ route('users.destroy', $user) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Sí, eliminar</button>
        </form>
    @endif
@endsection
