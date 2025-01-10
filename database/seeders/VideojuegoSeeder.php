<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Videojuego;
use App\Models\User;

class VideojuegoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::first();

        Videojuego::create([
            'titulo' => 'The Legend of Zelda',
            'descripcion' => 'Un videojuego de aventura y acción donde exploramos el mundo de Hyrule.',
            'caratula' => null,
            'user_id' => $admin->id
        ]);

        Videojuego::create([
            'titulo' => 'Super Mario Odyssey',
            'descripcion' => 'Un videojuego de plataformas 3D con el icónico Mario.',
            'caratula' => null,
            'user_id' => $admin->id
        ]);

        Videojuego::create([
            'titulo' => 'Halo Infinite',
            'descripcion' => 'Un videojuego de disparos en primera persona en un universo futurista.',
            'caratula' => null,
            'user_id' => $admin->id
        ]);

        // Relleno
        Videojuego::factory(50)->create(['user_id' => $admin->id]);
    }
}
