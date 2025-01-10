@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Videojuegos</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Carátula</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($videojuegos as $videojuego)
            <tr>
                <td>{{ $videojuego->titulo }}</td>
                <td>{{ $videojuego->descripcion }}</td>
                <td>
                    @if ($videojuego->caratula)
                    <img src="{{ asset('storage/' . $videojuego->caratula) }}" alt="Carátula" style="width: 100px;">
                    @else
                    Sin carátula
                    @endif
                </td>
                <td>
                    <a href="{{ route('videojuegos.show', $videojuego) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('videojuegos.edit', $videojuego) }}" class="btn btn-warning">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Enlaces de paginación -->
    <div class="d-flex justify-content-center">
        {{ $videojuegos->links() }}
    </div>
</div>
@endsection