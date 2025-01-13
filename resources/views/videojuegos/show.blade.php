@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-3xl font-bold text-purple-700 mb-4">{{ $videojuego->titulo }}</h1>
            <p class="text-gray-700 text-lg mb-4">{{ $videojuego->descripcion }}</p>

            @if ($videojuego->caratula)
                <img src="{{ asset('storage/caratulas/' . $videojuego->caratula) }}" alt="Carátula"
                    class="w-16 h-auto rounded-md shadow-md">
            @endif

            <h2 class="text-2xl font-semibold text-purple-600 mb-4">Comentarios</h2>
            <div class="space-y-4">
                @forelse ($videojuego->comentarios as $comentario)
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <p class="font-bold text-purple-800">{{ $comentario->user->name }}</p>
                        <p class="text-gray-600">{{ $comentario->comentario }}</p>
                        <p class="text-sm text-yellow-500">Valoración: {{ $comentario->puntuacion }}
                            estrella{{ $comentario->puntuacion > 1 ? 's' : '' }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">No hay comentarios para este videojuego.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 mt-6">
            <h3 class="text-2xl font-semibold text-purple-600 mb-4">Agregar o Editar Valoración</h3>
            @php
                $comentarioExistente = $videojuego->comentarios->where('user_id', auth()->id())->first();
            @endphp

            <form
                action="{{ $comentarioExistente ? route('comentarios.update', $comentarioExistente->id) : route('comentarios.store', $videojuego->id) }}"
                method="POST" class="space-y-4">
                @csrf
                @if ($comentarioExistente)
                    @method('PUT')
                @endif
                <div>
                    <label for="puntuacion" class="block text-gray-700 font-medium">Puntuación (1-5):</label>
                    <select name="puntuacion" id="puntuacion"
                        class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-300 focus:ring-opacity-50"
                        required>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}"
                                {{ $comentarioExistente && $comentarioExistente->puntuacion == $i ? 'selected' : '' }}>
                                {{ $i }} estrella{{ $i > 1 ? 's' : '' }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label for="comentario" class="block text-gray-700 font-medium">Comentario (opcional):</label>
                    <textarea name="comentario" id="comentario"
                        class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-300 focus:ring-opacity-50"
                        placeholder="Escribe un comentario">{{ $comentarioExistente ? $comentarioExistente->comentario : '' }}</textarea>
                </div>

                <button type="submit"
                    class="w-full bg-purple-600 text-white font-semibold py-2 px-4 rounded hover:bg-purple-700">
                    {{ $comentarioExistente ? 'Actualizar Valoración' : 'Enviar Valoración' }}
                </button>
            </form>
        </div>

        <div class="mt-6 flex items-center space-x-4">
            @if (auth()->user()->is_admin || auth()->user()->id == $videojuego->user_id)
                <a href="{{ route('videojuegos.edit', $videojuego) }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Editar Videojuego
                </a>
            @endif

            @if (auth()->user()->is_admin)
                <form action="{{ route('videojuegos.destroy', $videojuego) }}" method="POST"
                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este videojuego?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Eliminar Videojuego
                    </button>
                </form>
            @endif
        </div>
    </div>
    </div>
@endsection
