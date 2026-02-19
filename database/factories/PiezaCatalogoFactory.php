<?php

namespace Database\Factories;

use App\Models\Adjunto;
use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PiezaCatalogo>
 */
class PiezaCatalogoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->words(3, true),
            'adjuntoId' => Adjunto::factory(),
            'colorId' => Color::factory(),
        ];
    }
}
