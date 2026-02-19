<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Materiales de impresion 3D
        $materiales = [
            ['nombre' => 'PLA'],
            ['nombre' => 'ABS'],
            ['nombre' => 'PETG'],
            ['nombre' => 'TPU'],
            ['nombre' => 'Nylon'],
        ];

        foreach ($materiales as $material) {
            Material::create($material);
        }
    }
}
