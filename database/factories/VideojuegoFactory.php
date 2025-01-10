<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Videojuego>
 */
class VideojuegoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->words(3, true),
            'descripcion' => $this->faker->paragraph, 
            'caratula' => null,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
