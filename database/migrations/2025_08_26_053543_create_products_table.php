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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Información básica del producto
            $table->string('name');
            $table->string('sku')->unique()->comment('Stock Keeping Unit - Identificador único para inventario');
            $table->string('code')->unique()->nullable()->comment('Código interno del producto');
            
            // Configuración de unidades y precios
             $table->decimal('default_cost', 10, 2)->nullable()->comment('Costo de referencia');
            $table->decimal('default_price', 10, 2)->nullable()->comment('Precio sugerido');

            // Gestión de inventario
             $table->decimal('min_stock', 10, 2)->default(0)->comment('Stock mínimo alerta');
            $table->decimal('max_stock', 10, 2)->nullable()->comment('Stock máximo recomendado');

            // Fechas críticas
            $table->date('creation_date')->nullable()->comment('Fecha de creación del producto');
            
            // Estado y control
            $table->boolean('active')->default(true);
            $table->boolean('track_expiration')->default(false)->comment('¿Requiere seguimiento de caducidad?');
            $table->boolean('track_quantity')->default(true)->comment('¿Requiere control de inventario?');

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete()
                ->comment('Categoría del producto');
            $table->foreignId('unit_id')->constrained('units');    

            // Auditoría
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            // Índices compuestos para mejor performance
            $table->index(['sku', 'active']);
            $table->index(['active', 'deleted_at']);
            
           
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
