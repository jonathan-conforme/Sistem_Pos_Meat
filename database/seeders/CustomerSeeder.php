<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->updateOrInsert(
            ['cedula' => '9999999999'], // La cédula universal para consumidor final
            [
                'name' => 'Consumidor Final',
                'email' => 'consumidorfinal@example.com', 
                'phone' => '9999999999',
                'address' => 'S/N', // Sin número / Dirección por defecto
                'is_final_consumer' => true, // ¡Tu bandera especial activada!
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}