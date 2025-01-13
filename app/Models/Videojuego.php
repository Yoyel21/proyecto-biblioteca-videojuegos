<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Videojuego extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'titulo',
        'descripcion',
        'caratula',
        'user_id'
    ];

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    /**
     * Get the user that owns the Videojuego
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}