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
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->nullOnDelete();
            $table->date('purchase_date');
            $table->text('notes')->nullable()->comment('Observaciones de la compra');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('total', 12, 2)->default(0)->comment('Total de la compra');
            
            $table->timestamps();
            $table->softDeletes();
            
            // Índices
            $table->index('purchase_date');
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
