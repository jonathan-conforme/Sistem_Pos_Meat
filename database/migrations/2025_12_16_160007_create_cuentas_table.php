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
      Schema::create('cuentas', function (Blueprint $table) {
    $table->id(); // bigint unsigned

    $table->string('nombre'); 
    // Caja principal, Banco Pichincha, etc.

    $table->enum('tipo', ['caja', 'banco']);
    // caja = efectivo
    // banco = cuentas bancarias

    $table->decimal('saldo_inicial', 12, 2)->default(0);

    $table->decimal('saldo_actual', 12, 2)->default(0);
    // se actualiza con movimientos

    $table->boolean('activa')->default(true);

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas');
    }
};
