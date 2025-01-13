@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-purple-700 mb-6">Editar Videojuego</h1>
    <form method="POST" action="{{ route('videojuegos.update', $videojuego->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Título -->
        <div class="mb-4">
            <label for="titulo" class="block text-gray-700 font-medium mb-2">Título</label>
            <input 
                type="text" 
                name="titulo" 
                id="titulo" 
                class="w-full border border-gray-300 rounded-md p-2" 
                value="{{ old('titulo', $videojuego->titulo) }}"
                required>
            @error('titulo')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Descripción -->
        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700 font-medium mb-2">Descripción</label>
            <textarea 
                name="descripcion" 
                id="descripcion" 
                rows="5" 
                class="w-full border border-gray-300 rounded-md p-2"
                required>{{ old('descripcion', $videojuego->descripcion) }}</textarea>
            @error('descripcion')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Carátula actual -->
        @if ($videojuego->caratula)
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Carátula actual</label>
            <img 
                src="{{ asset('storage/' . $videojuego->caratula) }}" 
                alt="Carátula actual" 
                class="w-32 h-auto rounded-md shadow-md">
        </div>
        @endif

        <!-- Subir nueva carátula -->
        <div class="mb-4">
            <label for="caratula" class="block text-gray-700 font-medium mb-2">Nueva carátula (opcional)</label>
            <input 
                type="file" 
                name="caratula" 
                id="caratula" 
                class="block w-full border border-gray-300 rounded-md p-2">
            @error('caratula')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botón de guardar cambios -->
        <div class="flex justify-end">
            <button 
                type="submit" 
                class="bg-purple-700 hover:bg-purple-800 text-white font-bold py-2 px-4 rounded">
                Guardar cambios
            </button>
        </div>
    </form>
</div>
@endsection