<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario administrador
        User::factory()->create([
            'nombre' => 'Admin',
            'apellidos' => 'MakeThis',
            'email' => 'admin@makethis.es',
            'isAdmin' => true,
        ]);

        // Usuario de prueba
        User::factory()->create([
            'nombre' => 'Usuario',
            'apellidos' => 'Prueba',
            'email' => 'user@makethis.es',
            'isAdmin' => false,
        ]);

        // Usuarios aleatorios
        User::factory(8)->create();
    }
}
