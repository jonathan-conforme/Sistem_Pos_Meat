<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
              // ingreso | egreso | transferencia
            $table->enum('tipo', ['ingreso', 'egreso', 'transferencia']);

            // cuenta origen (caja / banco)
            $table->foreignId('cuenta_id')
                  ->constrained('cuentas')
                  ->cascadeOnDelete();

            // solo para transferencias
            $table->foreignId('cuenta_destino_id')
                  ->nullable()
                  ->constrained('cuentas')
                  ->nullOnDelete();

            $table->date('fecha');
            $table->decimal('monto', 12, 2);

            $table->string('metodo_pago')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('referencia')->nullable();

            $table->foreignId('created_by')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
