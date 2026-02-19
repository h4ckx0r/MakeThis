<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adjunto>
 */
class AdjuntoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $extension = fake()->randomElement(['stl', 'obj', '3mf']);

        return [
            'nombreFichero' => fake()->words(2, true) . '.' . $extension,
            'idSolicitud' => null,
            'fichero' => 'adjuntos/' . fake()->uuid() . '.' . $extension,
        ];
    }
}
