<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unidades = [
            ['name' => 'Unidad', 'symbol' => 'Un'],
            ['name' => 'Pieza', 'symbol' => 'Pza'],
            ['name' => 'Kilogramo', 'symbol' => 'Kg'],
            ['name' => 'Gramo', 'symbol' => 'g'],
            ['name' => 'Litro', 'symbol' => 'L'],
            ['name' => 'Mililitro', 'symbol' => 'ml'],
            ['name' => 'Paquete', 'symbol' => 'Pqte'],
            ['name' => 'Caja', 'symbol' => 'Caja'],
            ['name' => 'Galón', 'symbol' => 'Gal'],
            ['name' => 'Botellón', 'symbol' => 'Bttn'], // ¡Perfecto para tus aguas de 20L!
        ];

        foreach ($unidades as $unidad) {
            DB::table('units')->updateOrInsert(
                ['symbol' => $unidad['symbol']], // Busca por el símbolo único
                [
                    'name' => $unidad['name'],
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}