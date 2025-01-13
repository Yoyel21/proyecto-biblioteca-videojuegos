<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo videojuego creado</title>
</head>

<body>
    <h1>Nuevo videojuego creado</h1>
    <p>Un nuevo videojuego ha sido añadido:</p>
    <ul>
        <li><strong>Título:</strong> {{ $videojuego->titulo }}</li>
        <li><strong>Descripción:</strong> {{ $videojuego->descripcion }}</li>
        <li><strong>Creado por:</strong> {{ $videojuego->user->name }} ({{ $videojuego->user->email }})</li>
        <li><strong>Fecha de creación:</strong> {{ $videojuego->created_at }}</li>
    </ul>
    @if ($videojuego->caratula)
        <p><strong>Carátula:</strong></p>
        <img src="{{ asset('storage/caratulas/' . $videojuego->caratula) }}" alt="Carátula del videojuego" style="max-width: 200px;">
    @endif
</body>

</html>