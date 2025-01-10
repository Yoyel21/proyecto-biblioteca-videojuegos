@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bienvenido a la Biblioteca de Videojuegos</h1>
    <a href="{{ route('videojuegos.index') }}" class="btn btn-primary">Ver Videojuegos</a>
</div>
@endsection