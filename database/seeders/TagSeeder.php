<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tags para piezas del catalogo
        $tags = [
            ['nombre' => 'mecanico'],
            ['nombre' => 'decorativo'],
            ['nombre' => 'funcional'],
            ['nombre' => 'juguete'],
            ['nombre' => 'herramienta'],
            ['nombre' => 'soporte'],
            ['nombre' => 'conectores'],
            ['nombre' => 'organizacion'],
            ['nombre' => 'prototipo'],
            ['nombre' => 'repuesto'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
