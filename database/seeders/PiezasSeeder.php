<?php

namespace Database\Seeders;

use App\Models\Adjunto;
use App\Models\Color;
use App\Models\Material;
use App\Models\PiezaCatalogo;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PiezasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener colores PLA para asignar a las piezas
        $materialPLA = Material::where('nombre', 'PLA')->first();
        $coloresPLA = Color::where('materialId', $materialPLA->id)->get();

        // Piezas del catalogo con sus adjuntos y tags
        $piezas = [
            [
                'nombre' => 'Engranaje Mecanico',
                'fichero' => 'catalogo/engranaje_mecanico.stl',
                'tags' => ['mecanico', 'funcional'],
            ],
            [
                'nombre' => 'Maceta Decorativa',
                'fichero' => 'catalogo/maceta_decorativa.stl',
                'tags' => ['decorativo', 'organizacion'],
            ],
            [
                'nombre' => 'Soporte para Telefono',
                'fichero' => 'catalogo/soporte_telefono.stl',
                'tags' => ['soporte', 'funcional'],
            ],
            [
                'nombre' => 'Juguete Articulado',
                'fichero' => 'catalogo/juguete_articulado.3mf',
                'tags' => ['juguete', 'decorativo'],
            ],
            [
                'nombre' => 'Caja de Herramientas Mini',
                'fichero' => 'catalogo/caja_herramientas.stl',
                'tags' => ['organizacion', 'herramienta'],
            ],
            [
                'nombre' => 'Conector Rapido',
                'fichero' => 'catalogo/conector_rapido.stl',
                'tags' => ['conectores', 'funcional'],
            ],
            [
                'nombre' => 'Organizador de Escritorio',
                'fichero' => 'catalogo/organizador_escritorio.3mf',
                'tags' => ['organizacion', 'decorativo'],
            ],
            [
                'nombre' => 'Pieza de Ajedrez',
                'fichero' => 'catalogo/pieza_ajedrez.stl',
                'tags' => ['juguete', 'decorativo'],
            ],
            [
                'nombre' => 'Bracket de Montaje',
                'fichero' => 'catalogo/bracket_montaje.stl',
                'tags' => ['soporte', 'mecanico'],
            ],
            [
                'nombre' => 'Llavero Personalizado',
                'fichero' => 'catalogo/llavero.stl',
                'tags' => ['decorativo', 'funcional'],
            ],
        ];

        foreach ($piezas as $index => $piezaData) {
            // Crear adjunto para la pieza
            $adjunto = Adjunto::create([
                'nombreFichero' => basename($piezaData['fichero']),
                'idSolicitud' => null,
                'fichero' => $piezaData['fichero'],
            ]);

            // Asignar un color PLA rotando
            $color = $coloresPLA[$index % $coloresPLA->count()];

            // Crear la pieza de catalogo
            $pieza = PiezaCatalogo::create([
                'nombre' => $piezaData['nombre'],
                'adjuntoId' => $adjunto->id,
                'colorId' => $color->id,
            ]);

            // Asociar tags
            $tagIds = Tag::whereIn('nombre', $piezaData['tags'])->pluck('id');
            $pieza->tags()->attach($tagIds);
        }
    }
}
