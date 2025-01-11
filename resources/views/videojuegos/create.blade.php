@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-8">
    <h1 class="text-3xl font-semibold text-center text-purple-600 mb-6">Crear Videojuego</h1>
    
    <form method="POST" action="{{ route('videojuegos.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-6">
            <label for="titulo" class="block text-gray-700 font-semibold mb-2">Título</label>
            <input type="text" name="titulo" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" id="titulo" value="{{ old('titulo') }}">
            @error('titulo')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-6">
            <label for="descripcion" class="block text-gray-700 font-semibold mb-2">Descripción</label>
            <textarea name="descripcion" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" id="descripcion">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-6">
            <label for="caratula" class="block text-gray-700 font-semibold mb-2">Carátula (opcional):</label>
            <input type="file" name="caratula" id="caratula" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div>

        <div class="flex justify-center">
            <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                Crear Videojuego
            </button>
        </div>
    </form>
</div>
@endsection