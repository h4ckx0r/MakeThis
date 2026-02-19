<?php

namespace Database\Factories;

use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ThreeDModel>
 */
class ThreeDModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipo = fake()->randomElement(['stl', 'obj', '3mf']);

        return [
            'nombreModelo' => fake()->words(3, true),
            'tipo' => $tipo,
            'modelo' => 'models/' . fake()->uuid() . '.' . $tipo,
            'colorId' => Color::factory(),
        ];
    }
}
