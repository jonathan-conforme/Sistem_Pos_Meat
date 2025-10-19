<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
         $permissions = [
            'gestionar usuarios',
            'gestionar productos',
            'gestionar facturas',
            'ver reportes',
        ];

       foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web' // Recomendado agregar esto
            ]);
        }
    
    }
}
