<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $rolePermissions = [
            'administrador' => Permission::pluck('name')->toArray(),
            'vendedor' => ['gestionar facturas'],
            'contador' => ['gestionar facturas', 'ver reportes'],
            'inventario' => ['gestionar productos'],
        ];

        foreach ($rolePermissions as $roleName => $permissions) {
            $role = Role::firstWhere(['name' => $roleName, 'guard_name' => 'web']);

            if (!$role) {
                $this->command->warn("Rol {$roleName} no encontrado. Saltando...");
                continue;
            }

            // Verificar que los permisos existan
            $existingPermissions = Permission::whereIn('name', $permissions)->pluck('name')->toArray();
            $missingPermissions = array_diff($permissions, $existingPermissions);

            if (!empty($missingPermissions)) {
                $this->command->warn("Permisos no encontrados para {$roleName}: " . implode(', ', $missingPermissions));
            }

            $role->syncPermissions($existingPermissions);
            $this->command->info("Permisos asignados a {$roleName}: " . implode(', ', $existingPermissions));
        }
    }
}
