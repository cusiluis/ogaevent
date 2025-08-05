<?php
// database/seeders/UsuarioSeeder.php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::create([
            'nombre' => 'Administrador',
            'email' => 'admin@example.com',
            'password_hash' => bcrypt('password'),
            'rol' => 'admin'
        ]);

        Usuario::create([
            'nombre' => 'Empleado',
            'email' => 'employee@example.com',
            'password_hash' => bcrypt('password'),
            'rol' => 'employee'
        ]);
    }
}