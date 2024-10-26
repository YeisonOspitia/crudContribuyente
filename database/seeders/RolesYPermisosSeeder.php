<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesYPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Crear permisos
         Permission::create(['name' => 'edit contribuyente']);
         Permission::create(['name' => 'delete contribuyente']);
         
         // Crear roles y asignar permisos
         $role = Role::create(['name' => 'admin']);
         $role->givePermissionTo('edit contribuyente');
         $role->givePermissionTo('delete contribuyente');

        // Crear usuario si no existe
        $user = \App\Models\User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'password' => bcrypt('password')]
        );
        
         // Asignar roles a un usuario
        $user->assignRole('admin');
    }
}
