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
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();

    // Producto afectado
    $table->foreignId('product_id')
        ->constrained()
        ->cascadeOnDelete();

    // Tipo de movimiento
    $table->enum('type', [
        'purchase',
        'sale',
        'adjustment',
        'merma',
        'return'
    ]);

    // Cantidad del movimiento
    $table->decimal('quantity', 12, 3);

    // Stock antes del movimiento
    $table->decimal('stock_before', 12, 3);

    // Stock después del movimiento
    $table->decimal('stock_after', 12, 3);

    // Referencia del documento
    $table->unsignedBigInteger('reference_id')->nullable();

    // Tipo de referencia
    $table->string('reference_type')->nullable();

    // Usuario que hizo el movimiento
    $table->foreignId('created_by')
        ->nullable()
        ->constrained('users')
        ->nullOnDelete();

    $table->text('notes')->nullable();

    $table->timestamps();

    // índices
    $table->index('product_id');
    $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};
