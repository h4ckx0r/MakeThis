<?php

namespace Database\Factories;

use App\Models\Solicitud;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reporte>
 */
class ReporteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'solicitudId' => Solicitud::factory(),
            'fecha' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'titulo' => fake()->sentence(4),
            'descripcion' => fake()->paragraphs(2, true),
        ];
    }
}
