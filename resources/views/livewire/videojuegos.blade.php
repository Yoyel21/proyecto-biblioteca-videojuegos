<x-layouts.app>
<div>
@section('content')
<div class="container">
    <h1 class="text-center my-4">Lista de Videojuegos</h1>
    <a href="{{ route('videojuegos.create') }}" class="btn btn-primary mb-4">Añadir Videojuego</a>
    <div class="row">
        @foreach ($videojuegos as $videojuego)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if ($videojuego->caratula)
                        <img src="{{ asset('storage/' . $videojuego->caratula) }}" class="card-img-top" alt="Carátula">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $videojuego->titulo }}</h5>
                        <p class="card-text">{{ Str::limit($videojuego->descripcion, 100) }}</p>
                        <a href="{{ route('videojuegos.show', $videojuego->id) }}" class="btn btn-info">Ver detalles</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $videojuegos->links() }} <!-- Paginación -->
</div>
@endsection
</div>
</x-layouts.app>
