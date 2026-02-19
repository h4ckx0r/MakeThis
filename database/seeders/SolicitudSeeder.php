<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Estado;
use App\Models\Solicitud;
use App\Models\ThreeDModel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SolicitudSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('isAdmin', false)->get();
        $estados = Estado::all();
        $colors = Color::all();

        $patronesRelleno = ['rejilla', 'giroide', 'cubico', 'panal_de_abeja', 'panal_de_abeja_3d'];

        // Solicitudes con sus modelos 3D y detalles
        $solicitudes = [
            [
                'nombreModelo' => 'Carcasa movil personalizada',
                'tipo' => 'stl',
                'detalles' => 'Necesito esta pieza con acabado liso. Es para uso exterior, debe resistir la lluvia.',
            ],
            [
                'nombreModelo' => 'Soporte para tablet',
                'tipo' => 'stl',
                'detalles' => 'Prototipo funcional para validar dimensiones antes de produccion final.',
            ],
            [
                'nombreModelo' => 'Pieza repuesto lavadora',
                'tipo' => 'obj',
                'detalles' => 'Pieza de repuesto para electrodomestico. Las medidas deben ser exactas.',
            ],
            [
                'nombreModelo' => 'Figura decorativa dragon',
                'tipo' => '3mf',
                'detalles' => 'Figura decorativa para regalo. Preferiblemente sin marcas de soporte visibles.',
            ],
            [
                'nombreModelo' => 'Engranaje de recambio',
                'tipo' => 'stl',
                'detalles' => 'Engranaje de recambio para maquina industrial. Requiere alta resistencia.',
            ],
            [
                'nombreModelo' => 'Caja para Arduino',
                'tipo' => '3mf',
                'detalles' => 'Caja para proyecto de electronica. Necesita orificios para ventilacion.',
            ],
            [
                'nombreModelo' => 'Adaptador tuberia',
                'tipo' => 'stl',
                'detalles' => 'Adaptador a medida. Adjunto planos con dimensiones exactas.',
            ],
            [
                'nombreModelo' => 'Maqueta arquitectonica',
                'tipo' => 'obj',
                'detalles' => 'Maqueta a escala 1:100. Priorizar detalle sobre resistencia.',
            ],
            [
                'nombreModelo' => 'Protesis dental provisional',
                'tipo' => 'stl',
                'detalles' => 'Pieza temporal mientras llega la original. No requiere mucha durabilidad.',
            ],
            [
                'nombreModelo' => 'Soporte altavoz pared',
                'tipo' => 'stl',
                'detalles' => 'Soporte a medida para pared de pladur. Debe soportar 2kg.',
            ],
            [
                'nombreModelo' => 'Organizador cables',
                'tipo' => '3mf',
                'detalles' => 'Organizador para escritorio. Preferencia por acabado mate.',
            ],
            [
                'nombreModelo' => 'Tapa protectora sensor',
                'tipo' => 'stl',
                'detalles' => 'Tapa protectora para uso en exteriores. Necesita resistencia UV.',
            ],
            [
                'nombreModelo' => 'Marco para foto',
                'tipo' => 'obj',
                'detalles' => 'Marco personalizado con nombre grabado en la parte inferior.',
            ],
            [
                'nombreModelo' => 'Clip para cinturon',
                'tipo' => 'stl',
                'detalles' => 'Clip con cierre a presion. Debe ser flexible pero resistente.',
            ],
            [
                'nombreModelo' => 'Base para lampara LED',
                'tipo' => '3mf',
                'detalles' => 'Base para lampara LED con canal integrado para el cableado.',
            ],
        ];

        foreach ($solicitudes as $data) {
            $color = $colors->random();

            // Crear modelo 3D
            $threeDModel = ThreeDModel::create([
                'nombreModelo' => $data['nombreModelo'],
                'tipo' => $data['tipo'],
                'modelo' => 'models/' . Str::slug($data['nombreModelo']) . '.' . $data['tipo'],
                'colorId' => $color->id,
            ]);

            // Crear solicitud
            Solicitud::create([
                'userId' => $users->random()->id,
                'estadoId' => $estados->random()->id,
                'detalles' => $data['detalles'],
                '3dModelId' => $threeDModel->id,
                'porcentajeRelleno' => fake()->randomElement([10, 15, 20, 25, 30, 50, 75, 100]),
                'alturaCapa' => fake()->randomElement([0.1, 0.15, 0.2, 0.25, 0.3]),
                'patronRelleno' => $patronesRelleno[array_rand($patronesRelleno)],
            ]);
        }
    }
}
