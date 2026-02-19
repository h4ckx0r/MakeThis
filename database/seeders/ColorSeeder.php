<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Material;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Colores por material
        $coloresPorMaterial = [
            'PLA' => [
                ['nombre' => 'Blanco',          'hexColor' => 'FFFFFF'],
                ['nombre' => 'Negro',           'hexColor' => '000000'],
                ['nombre' => 'Rojo',            'hexColor' => 'DC2626'],
                ['nombre' => 'Azul',            'hexColor' => '2563EB'],
                ['nombre' => 'Verde',           'hexColor' => '16A34A'],
                ['nombre' => 'Amarillo',        'hexColor' => 'EAB308'],
                ['nombre' => 'Naranja',         'hexColor' => 'EA580C'],
                ['nombre' => 'Gris',            'hexColor' => '6B7280'],
                ['nombre' => 'Rosa',            'hexColor' => 'EC4899'],
                ['nombre' => 'Madera',          'hexColor' => '92400E'],
            ],
            'ABS' => [
                ['nombre' => 'Blanco',          'hexColor' => 'F5F5F5'],
                ['nombre' => 'Negro',           'hexColor' => '1A1A1A'],
                ['nombre' => 'Rojo',            'hexColor' => 'B91C1C'],
                ['nombre' => 'Azul',            'hexColor' => '1D4ED8'],
                ['nombre' => 'Gris',            'hexColor' => '4B5563'],
                ['nombre' => 'Amarillo',        'hexColor' => 'CA8A04'],
            ],
            'PETG' => [
                ['nombre' => 'Transparente',     'hexColor' => 'E5E7EB'],
                ['nombre' => 'Negro',            'hexColor' => '111827'],
                ['nombre' => 'Blanco',           'hexColor' => 'F9FAFB'],
                ['nombre' => 'Azul translucido', 'hexColor' => '60A5FA'],
                ['nombre' => 'Rojo translucido', 'hexColor' => 'F87171'],
                ['nombre' => 'Verde translucido','hexColor' => '4ADE80'],
            ],
            'TPU' => [
                ['nombre' => 'Negro',           'hexColor' => '0A0A0A'],
                ['nombre' => 'Blanco',          'hexColor' => 'FAFAFA'],
                ['nombre' => 'Rojo',            'hexColor' => 'EF4444'],
                ['nombre' => 'Azul',            'hexColor' => '3B82F6'],
                ['nombre' => 'Transparente',    'hexColor' => 'D1D5DB'],
            ],
            'Nylon' => [
                ['nombre' => 'Natural',         'hexColor' => 'FEF3C7'],
                ['nombre' => 'Negro',           'hexColor' => '171717'],
                ['nombre' => 'Blanco',          'hexColor' => 'F5F5F4'],
            ],
        ];

        foreach ($coloresPorMaterial as $materialNombre => $colores) {
            $material = Material::where('nombre', $materialNombre)->first();

            foreach ($colores as $color) {
                Color::create([
                    'nombre' => $color['nombre'],
                    'hexColor' => $color['hexColor'],
                    'materialId' => $material->id,
                ]);
            }
        }
    }
}
