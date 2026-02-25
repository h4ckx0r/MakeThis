<?php

namespace Database\Factories;

use App\Models\Estado;
use App\Models\ThreeDModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Solicitud>
 */
class SolicitudFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'userId' => User::factory(),
            'estadoId' => Estado::factory(),
            'detalles' => fake()->paragraph(),
            '3dModelId' => ThreeDModel::factory(),
            'porcentajeRelleno' => fake()->randomElement([10, 15, 20, 25, 30, 50, 75, 100]),
            'alturaCapa' => fake()->randomElement([0.1, 0.15, 0.2, 0.25, 0.3]),
            'patronRelleno' => fake()->randomElement(['rejilla', 'giroide', 'cubico', 'panal_de_abeja', 'panal_de_abeja_3d']),
        ];
    }
}
