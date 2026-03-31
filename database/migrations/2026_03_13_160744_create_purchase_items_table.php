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
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('purchase_id')->constrained('purchases')->onDelete('cascade');
            $table->decimal('quantity', 12, 3)->comment('Cantidad comprada');
            $table->decimal('cost_per_unit', 10, 3)->comment('Costo por unidad');
            $table->decimal('weight_bruto_lb', 10, 3)->nullable()->comment('Peso bruto en libras');
            $table->decimal('weight_neto_lb', 10, 3)->nullable()->comment('Peso neto en libras');
            $table->decimal('merma_percentage', 5, 2)->nullable()->comment('Porcentaje de merma');
            $table->decimal('merma_lb', 10, 3)->nullable()->comment('Merma en libras');
            $table->decimal('subtotal', 10, 2)->nullable()->comment('Subtotal');
            $table->timestamps();
            
            // Índices para optimizar consultas frecuentes
             
            $table->index('purchase_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
