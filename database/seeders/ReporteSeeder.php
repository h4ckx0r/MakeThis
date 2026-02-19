<?php

namespace Database\Seeders;

use App\Models\Reporte;
use App\Models\Solicitud;
use Illuminate\Database\Seeder;

class ReporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $solicitudes = Solicitud::all();

        // Reportes realistas de incidencias de impresion 3D
        $reportesTipos = [
            [
                'titulo' => 'Impresion completada con exito',
                'descripcion' => 'La pieza se ha impreso correctamente segun las especificaciones del cliente. Acabado superficial bueno, sin defectos visibles. Dimensiones verificadas dentro de tolerancia.',
            ],
            [
                'titulo' => 'Fallo en primera capa',
                'descripcion' => 'La primera capa no adhirio correctamente a la cama de impresion. Se reajusto la nivelacion y temperatura de cama. Segunda impresion completada sin problemas.',
            ],
            [
                'titulo' => 'Material insuficiente',
                'descripcion' => 'No habia suficiente filamento del color solicitado. Se contacto al cliente para ofrecer alternativas. Se procedera con el nuevo color confirmado.',
            ],
            [
                'titulo' => 'Solicitud rechazada por geometria',
                'descripcion' => 'El modelo 3D presenta voladizos superiores a 60 grados sin posibilidad de soportes. Se recomienda al cliente redisenar la pieza o aceptar soportes internos.',
            ],
            [
                'titulo' => 'Control de calidad superado',
                'descripcion' => 'La pieza ha pasado todas las verificaciones dimensionales y de resistencia. Lista para entrega al cliente.',
            ],
            [
                'titulo' => 'Reimpresion necesaria',
                'descripcion' => 'Se detecto un desplazamiento de capas a mitad de impresion causado por vibraciones. Se ha programado una reimpresion con velocidad reducida.',
            ],
        ];

        // Crear reportes para un subconjunto de solicitudes
        $solicitudesConReporte = $solicitudes->random(min(8, $solicitudes->count()));

        foreach ($solicitudesConReporte as $index => $solicitud) {
            $reporteData = $reportesTipos[$index % count($reportesTipos)];

            Reporte::create([
                'solicitudId' => $solicitud->id,
                'fecha' => fake()->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
                'titulo' => $reporteData['titulo'],
                'descripcion' => $reporteData['descripcion'],
            ]);
        }
    }
}
