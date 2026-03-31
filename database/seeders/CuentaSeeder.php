<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CuentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Cuenta Bancaria (El ID debe coincidir con tu config/finance.php)
        DB::table('cuentas')->updateOrInsert(
            ['id' => config('finance.accounts.bank', 1)], // Busca el ID 1
            [
                'nombre' => 'Banco Principal',
                'tipo' => 'banco',
                'saldo_inicial' => 0,
                'saldo_actual' => 0,
                'activa' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // 2. Cuenta de Efectivo (El ID debe coincidir con tu config/finance.php)
        DB::table('cuentas')->updateOrInsert(
            ['id' => config('finance.accounts.cash', 2)], // Busca el ID 2
            [
                'nombre' => 'Caja General (Efectivo)',
                'tipo' => 'caja',
                'saldo_inicial' => 0,
                'saldo_actual' => 0,
                'activa' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
