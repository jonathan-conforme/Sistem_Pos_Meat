<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $this->call([
        PermissionsSeeder::class,
        RolesSeeder::class,
        RolePermissionSeeder::class,
        CuentaSeeder::class,
        UnitSeeder::class,
        CategorySeeder::class,
        CustomerSeeder::class,
    ]);
     // Asignar rol al usuario creado
    $user = User::create([
        'name' => 'Admin',
        'email' => 'test@example.com',
        'password' => \Illuminate\Support\Facades\Hash::make('password'),
    ]);
     // Asignar rol administrador
        $user->assignRole('administrador');
    
}
}
