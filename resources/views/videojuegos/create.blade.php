<form action="{{ route('videojuegos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" placeholder="Título del videojuego" required>
    
    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" placeholder="Descripción"></textarea>
    
    <label for="caratula">Carátula:</label>
    <input type="file" id="caratula" name="caratula" accept="image/*">
    
    <button type="submit">Guardar</button>
</form>
