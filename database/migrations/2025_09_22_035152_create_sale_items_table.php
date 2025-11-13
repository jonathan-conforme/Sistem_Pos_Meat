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
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
              $table->enum('sale_mode', ['weight', 'amount', 'unit']);
            $table->float('quantity', 12, 2)->nullable()->comment('Cantidad vendida');
            $table->decimal('amount', 12, 2)->nullable()->comment('Monto fijo si aplica');
            $table->float('price_per_unit', 10, 2)->comment('Precio por unidad/lb');
            $table->float('cost_per_unit', 10, 2)->nullable()->comment('Costo por unidad en el momento de venta');
            $table->decimal('subtotal', 12, 2);
            $table->decimal('profit', 12, 2)->nullable()->comment('Ganancia calculada');
            $table->foreignId('sale_id')->constrained('sales')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('inventory_id')->nullable()->constrained('inventories')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
            
            // Índices
            $table->index('sale_id');
            $table->index('product_id');
            $table->index('sale_mode');
            $table->index('deleted_at');
            
         
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};
