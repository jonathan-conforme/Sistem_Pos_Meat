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
        Schema::create('expenses', function (Blueprint $table) {
    $table->id();
    // Fecha contable real del egreso
    $table->date('expense_date');
    // Monto del egreso
    $table->decimal('amount', 12, 2);
    // Descripción corta
    $table->string('description');
    // Comentario opcional
    $table->text('comment')->nullable();
    // Método de pago
    $table->enum('payment_method', [
        'cash',
        'transfer',
        'card',
        'credit'
    ])->default('cash');
    // Número de factura / referencia
    $table->string('reference')->nullable();
    // Tipo de egreso
    $table->enum('type', [
        'gasto',   // fundas, bolsas, limpieza
        'Mercaderia',      // compra de mercadería (chancho, res)
        'mantenimiento',   // máquinas, herramientas
        'servicio',       // luz, agua, internet
        'otro'
    ])->default('gasto');
    $table->foreignId('movimiento_id')
          ->nullable()
          ->constrained('movimientos')
          ->nullOnDelete();
    // Usuario que registró
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
        Schema::dropIfExists('expenses');
    }
};
