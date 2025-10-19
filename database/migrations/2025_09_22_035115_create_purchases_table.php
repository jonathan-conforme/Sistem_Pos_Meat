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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
           $table->string('purchase_number')->unique()->comment('Número de compra único');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->nullOnDelete();
            $table->decimal('quantity', 12, 3)->comment('Cantidad comprada');
            $table->decimal('cost_per_unit', 10, 3)->comment('Costo por unidad');
            $table->decimal('weight_bruto_lb', 10, 3)->nullable()->comment('Peso bruto en libras');
            $table->decimal('weight_neto_lb', 10, 3)->nullable()->comment('Peso neto en libras');
            $table->decimal('merma_percentage', 5, 2)->nullable()->comment('Porcentaje de merma');
            $table->decimal('merma_lb', 10, 3)->nullable()->comment('Merma en libras');
            $table->date('purchase_date');
            $table->date('expiration_date')->nullable()->comment('Fecha de vencimiento');
            $table->text('notes')->nullable()->comment('Observaciones de la compra');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
            
            // Índices
            $table->index('purchase_date');
            $table->index('product_id');
            $table->index('supplier_id');
            $table->index('purchase_number');
            $table->index('deleted_at');
            
                 });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
