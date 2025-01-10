    @extends('layouts.app')

    @section('content')
    <form method="POST" action="{{ route('videojuegos.store') }}" enctype="multipart/form-data">
        @csrf
    
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" class="form-control" id="titulo" value="{{ old('titulo') }}">
            @error('titulo')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control" id="descripcion">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="caratula">Carátula</label>
            <input type="file" name="caratula" class="form-control" id="caratula">
            @error('caratula')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    
        <button type="submit" class="btn btn-primary">Crear Videojuego</button>
    </form>
    @endsection