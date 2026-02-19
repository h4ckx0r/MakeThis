<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Datos base sin dependencias
            MaterialSeeder::class,
            EstadoSeeder::class,
            TagSeeder::class,

            // Colores dependen de materiales
            ColorSeeder::class,

            // Usuarios
            UserSeeder::class,

            // Piezas de catalogo (dependen de adjuntos, colores y tags)
            PiezasSeeder::class,

            // Solicitudes (dependen de usuarios, estados, colores -> modelos 3D)
            SolicitudSeeder::class,

            // Reportes (dependen de solicitudes)
            ReporteSeeder::class,
        ]);
    }
}
