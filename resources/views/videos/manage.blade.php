@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Gestió de Vídeos</h1>

        <!-- Aquí pots llistar els vídeos o afegir la lògica per gestionar-los -->
        <ul>
            @foreach($videos as $video)
                <li>{{ $video->title }}</li>
            @endforeach
        </ul>
    </div>
@endsection
