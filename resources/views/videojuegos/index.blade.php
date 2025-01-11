@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded-md mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="container mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold text-purple-700 mb-6">Lista de Videojuegos</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg shadow-lg">
            <thead class="bg-purple-700 text-white">
                <tr>
                    <th class="text-left px-4 py-3">Título</th>
                    <th class="text-left px-4 py-3">Descripción</th>
                    <th class="text-left px-4 py-3">Carátula</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($videojuegos as $videojuego)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-purple-600 font-semibold">
                        <a href="{{ route('videojuegos.show', $videojuego) }}" class="hover:underline">
                            {{ $videojuego->titulo }}
                        </a>
                    </td>
                    <td class="px-4 py-3 text-gray-600">
                        {{ Str::limit($videojuego->descripcion, 50, '...') }}
                    </td>
                    <td class="px-4 py-3">
                        @if ($videojuego->caratula)
                            <img src="{{ asset('storage/caratulas/' . $videojuego->caratula) }}" alt="Carátula" class="w-16 h-auto rounded-md shadow-md">
                        @else
                            <span class="text-gray-500 italic">Sin carátula</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-8">
        {{ $videojuegos->links('pagination::tailwind') }}
    </div>
</div>
@endsection