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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
             $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->decimal('available_quantity', 12, 3)->default(0)->comment('Cantidad disponible');
            $table->decimal('min_stock', 12, 3)->default(0)->comment('Stock mínimo alerta');
            $table->decimal('max_stock', 12, 3)->nullable()->comment('Stock máximo recomendado');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
            
            // Índices
            $table->index('product_id');
            $table->index('available_quantity');
            $table->index('deleted_at');
            
            // Unique constraint para evitar inventarios duplicados
            $table->unique(['product_id', 'deleted_at']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
