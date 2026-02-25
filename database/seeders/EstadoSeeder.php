<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Estados del flujo de trabajo de solicitudes
        $estados = [
            ['nombreEstado' => 'Pendiente'],
            ['nombreEstado' => 'En revision'],
            ['nombreEstado' => 'Aprobada'],
            ['nombreEstado' => 'En impresion'],
            ['nombreEstado' => 'Control de calidad'],
            ['nombreEstado' => 'Completada'],
            ['nombreEstado' => 'Rechazada'],
            ['nombreEstado' => 'Cancelada'],
        ];

        foreach ($estados as $estado) {
            Estado::create($estado);
        }
    }
}
