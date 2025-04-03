@extends('layouts.app')

@section('content')
    <h1>Llista d'usuaris</h1>
    <form method="GET" action="{{ route('users.index') }}">
        <input type="text" name="search" placeholder="Cerca per nom o email">
        <button type="submit">Cercar</button>
    </form>
    <ul>
        @foreach ($users as $user)
            <li>
                <a href="{{ route('users.show', $user) }}">{{ $user->name }} - {{ $user->email }}</a>
            </li>
        @endforeach
    </ul>
@endsection
