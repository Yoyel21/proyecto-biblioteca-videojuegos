<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear roles
        $this->call(RoleSeeder::class);

        //Crear usuarios
        $this->call(UserSeeder::class);

        //Crear videojuegos
        $this->call(VideojuegoSeeder::class);
    }
}
