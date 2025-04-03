@extends('layouts.app')

@section('content')
    @if(auth()->user()->can('manage-users'))
        <h1>Crear Usuari</h1>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nom" required data-qa="input-name">
            <input type="email" name="email" placeholder="Email" required data-qa="input-email">
            <input type="password" name="password" placeholder="Contrasenya" required data-qa="input-password">
            <input type="password" name="password_confirmation" placeholder="Confirma la contrasenya" required data-qa="input-password-confirmation">
            <button type="submit" data-qa="submit-button">Desar</button>
        </form>
    @endif
@endsection
