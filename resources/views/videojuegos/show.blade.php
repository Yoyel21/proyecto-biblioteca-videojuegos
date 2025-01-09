<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de videojuegos</title>
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h1>{{ $videojuego->titulo }}</h1>
        <p>{{ $videojuego->descripcion }}</p>

        @if ($videojuego->caratula)
            <img src="{{ asset('storage/' . $videojuego->caratula) }}" alt="Carátula del videojuego">
        @endif

        <h2>Comentarios</h2>
        @forelse ($videojuego->comentarios as $comentario)
            <div>
                <p><strong>{{ $comentario->usuario->name }}:</strong> {{ $comentario->comentario }}</p>
                <p>Valoración: {{ $comentario->puntuacion }} estrellas</p>
            </div>
        @empty
            <p>No hay comentarios para este videojuego.</p>
        @endforelse

        <a href="{{ route('videojuegos.edit', $videojuego->id) }}" class="btn btn-primary">Editar</a>
        @if(auth()->user()->hasRole('admin'))
            <form action="{{ route('videojuegos.destroy', $videojuego->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        @endif
    </div>
    @endsection
</body>

</html>