<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user = Role::firstOrCreate(['name' => 'user']);

        // Crear permisos
        $permissions = [
            'edit_city',
            'delete_city',
            'view_weather',
            'manage_users',
        ];
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Asignar todos los permisos al admin
        $admin->permissions()->sync(Permission::all()->pluck('id'));
        // Asignar solo view_weather al user
        $user->permissions()->sync([
            Permission::where('name', 'view_weather')->first()->id
        ]);
    }
}
