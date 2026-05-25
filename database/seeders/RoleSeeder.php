<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Crea los roles disponibles en la aplicación
        $admin = Role::create(['name' => 'admin']);
        $user  = Role::create(['name' => 'user']);

        // Crea permisos básicos (opcional, útil para Spatie)
        $permissions = ['create', 'read', 'update', 'delete'];
        foreach ($permissions as $perm) {
            Permission::create(['name' => $perm]);
        }

        // Asigna todos los permisos al rol admin
        $admin->givePermissionTo($permissions);

        $this->command->info('Roles y permisos creados correctamente.');
    }
}
