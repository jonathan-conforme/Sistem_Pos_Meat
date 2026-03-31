<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lista de categorías con colores sugeridos (formato Hexadecimal)
        $categorias = [
            ['name' => 'Bebidas', 'color' => '#3B82F6'],           // Azul
            ['name' => 'Snacks y Dulces', 'color' => '#F59E0B'],   // Amarillo/Naranja
            ['name' => 'Abarrotes', 'color' => '#10B981'],         // Verde
            ['name' => 'Lácteos', 'color' => '#60A5FA'],           // Azul claro
            ['name' => 'Limpieza', 'color' => '#8B5CF6'],          // Morado
            ['name' => 'Cuidado Personal', 'color' => '#EC4899'],  // Rosa
            ['name' => 'Electrónica', 'color' => '#4B5563'],       // Gris oscuro
            ['name' => 'Otros', 'color' => '#9CA3AF'],             // Gris claro
        ];

        foreach ($categorias as $index => $cat) {
            // Generamos un código corto, ej: CAT-BEB-01
            $prefix = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $cat['name']), 0, 3));
            $codigo = 'CAT-' . $prefix . '-' . str_pad($index + 1, 2, '0', STR_PAD_LEFT);

            DB::table('categories')->updateOrInsert(
                ['name' => $cat['name']], // Busca si ya existe el nombre
                [
                    'code' => $codigo,
                    'description' => 'Categoría general de ' . $cat['name'],
                    'color' => $cat['color'],
                    'is_active' => true,
                    'sort_order' => $index + 1, // Las ordena del 1 al 8
                    'parent_id' => null,        // Todas nacen como categorías principales
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}