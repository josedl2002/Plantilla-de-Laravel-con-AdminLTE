<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crea el usuario administrador principal
        $admin = User::create([
            'name'     => 'mppt',
            'email'    => 'mppt@transporte.gob.ve',
            'password' => bcrypt('Mppt.2026'),
        ]);

        // Asigna el rol de admin (requiere ejecutar RoleSeeder primero)
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $admin->assignRole($adminRole);
        }

        // Crea usuarios de prueba adicionales
        User::create([
            'name'     => 'Usuario Demo',
            'email'    => 'demo@ejemplo.com',
            'password' => bcrypt('password'),
        ])->assignRole('user');

        $this->command->info('Usuarios creados correctamente.');
    }
}
