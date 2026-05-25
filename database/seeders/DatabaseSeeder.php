<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,   // Primero: roles y permisos
            UserSeeder::class,   // Segundo: usuarios con roles asignados
        ]);
    }
}
