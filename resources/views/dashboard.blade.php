@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-purple-700 mb-6">Bienvenido a Videogame Store</h1>
        <p class="text-gray-600 text-lg mb-10">Explora, agrega y gestiona tu colección de videojuegos de manera sencilla.</p>
        
        <div class="space-x-4">
            <a href="{{ route('videojuegos.index') }}" class="inline-block bg-purple-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-purple-700 transition duration-300">
                Ver Videojuegos
            </a>
            <a href="{{ route('videojuegos.create') }}" class="inline-block bg-green-500 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-green-600 transition duration-300">
                Crear Nuevo Videojuego
            </a>
        </div>
    </div>
</div>
@endsection