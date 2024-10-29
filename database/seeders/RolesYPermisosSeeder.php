<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesYPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Crear permisos si no existen
       $viewContribuyente = Permission::firstOrCreate(['name' => 'view contribuyente']);
       $createContribuyente = Permission::firstOrCreate(['name' => 'create contribuyente']);
       $editContribuyente = Permission::firstOrCreate(['name' => 'edit contribuyente']);
       $deleteContribuyente = Permission::firstOrCreate(['name' => 'delete contribuyente']);

       // Crear permisos para usuarios
       $viewUser = Permission::firstOrCreate(['name' => 'view user']);
       $createUser = Permission::firstOrCreate(['name' => 'create user']);
       $editUser = Permission::firstOrCreate(['name' => 'edit user']);
       $deleteUser = Permission::firstOrCreate(['name' => 'delete user']);

        // Crear rol y asignar permisos a Super Admin
        $superAdminRole = Role::firstOrCreate(['name' => 'super admin']);
        $superAdminRole->givePermissionTo(Permission::all()); // Super admin tiene todos los permisos

        // Crear rol y asignar permisos a Admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(['view contribuyente']);

        // Crear usuarios si no existen
        $superAdminUser = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            ['name' => 'Super Admin User', 'password' => bcrypt('password')]
        );
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'password' => bcrypt('password')]
        );

        // Asignar roles a los usuarios
        $superAdminUser->assignRole('super admin');
        $adminUser->assignRole('admin');
    }
}
