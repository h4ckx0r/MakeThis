<?php

namespace Database\Seeders;

use App\Models\Pieza;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PiezasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear tags
        $tags = [
            ['nombre' => 'mecanico'],
            ['nombre' => 'decorativo'],
            ['nombre' => 'funcional'],
            ['nombre' => 'juguete'],
            ['nombre' => 'herramienta'],
            ['nombre' => 'soporte'],
            ['nombre' => 'conectores'],
            ['nombre' => 'organización'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }

        // Crear piezas de ejemplo
        $piezas = [
            [
                'nombre' => 'Engranaje Mecánico',
                'descripcion' => 'Engranaje de precisión para aplicaciones mecánicas',
                'visible_catalogo' => true,
                'tags' => ['mecanico', 'funcional'],
            ],
            [
                'nombre' => 'Maceta Decorativa',
                'descripcion' => 'Maceta moderna con diseño minimalista',
                'visible_catalogo' => true,
                'tags' => ['decorativo', 'organización'],
            ],
            [
                'nombre' => 'Soporte para Teléfono',
                'descripcion' => 'Soporte ajustable para smartphone',
                'visible_catalogo' => true,
                'tags' => ['soporte', 'funcional'],
            ],
            [
                'nombre' => 'Juguete Articulado',
                'descripcion' => 'Juguete educativo con partes móviles',
                'visible_catalogo' => true,
                'tags' => ['juguete', 'decorativo'],
            ],
            [
                'nombre' => 'Caja de Herramientas Mini',
                'descripcion' => 'Caja compacta para organizar pequeñas herramientas',
                'visible_catalogo' => true,
                'tags' => ['organización', 'herramienta'],
            ],
            [
                'nombre' => 'Conector Rápido',
                'descripcion' => 'Conector modular para proyectos',
                'visible_catalogo' => true,
                'tags' => ['conectores', 'funcional'],
            ],
            [
                'nombre' => 'Organizador de Escritorio',
                'descripcion' => 'Organizador para lápices y accesorios',
                'visible_catalogo' => true,
                'tags' => ['organización', 'decorativo'],
            ],
            [
                'nombre' => 'Pieza de Ajedrez',
                'descripcion' => 'Pieza de ajedrez de tamaño estándar',
                'visible_catalogo' => true,
                'tags' => ['juguete', 'decorativo'],
            ],
            [
                'nombre' => 'Bracket de Montaje',
                'descripcion' => 'Soporte de montaje versátil',
                'visible_catalogo' => true,
                'tags' => ['soporte', 'mecanico'],
            ],
            [
                'nombre' => 'Llavero Personalizado',
                'descripcion' => 'Llavero con diseño personalizable',
                'visible_catalogo' => true,
                'tags' => ['decorativo', 'funcional'],
            ],
        ];

        foreach ($piezas as $piezaData) {
            $tags = $piezaData['tags'];
            unset($piezaData['tags']);

            $pieza = Pieza::create($piezaData);

            // Asociar tags
            foreach ($tags as $tagNombre) {
                $tag = Tag::where('nombre', $tagNombre)->first();
                if ($tag) {
                    $pieza->tags()->attach($tag->id);
                }
            }
        }
    }
}
