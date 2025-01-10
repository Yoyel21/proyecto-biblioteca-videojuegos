<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'videojuego_id',
        'puntuacion',
        'comentario'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function videojuego()
    {
        return $this->belongsTo(Videojuego::class, "videojuego_id");
    }

    public static function comentarioExistente($usuario_id, $videojuego_id)
    {
        return self::where('user_id', $usuario_id)
            ->where('videojuego_id', $videojuego_id)
            ->exists();
    }
}
