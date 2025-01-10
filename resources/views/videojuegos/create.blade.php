    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h1 class="text-center my-4">Añadir Nuevo Videojuego</h1>
        <form action="{{ route('videojuegos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" name="titulo" id="titulo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="caratula">Carátula</label>
                <input type="file" name="caratula" id="caratula" class="form-control">
            </div>
            <button type="submit" class="btn btn-success mt-3">Guardar</button>
        </form>
    </div>
    @endsection