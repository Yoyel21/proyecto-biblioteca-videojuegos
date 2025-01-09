<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videojuego extends Model
{
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
