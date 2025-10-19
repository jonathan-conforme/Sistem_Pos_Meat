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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('sale_number')->unique()->comment('Número de venta único');
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0)->comment('Impuestos');
            $table->decimal('discount', 10, 2)->default(0)->comment('Descuento');
            $table->decimal('total', 12, 2);
            $table->enum('payment_type', ['cash', 'card', 'transfer', 'credit'])->default('cash');
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('completed');
            $table->text('comments')->nullable();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Índices
            $table->index('sale_number');
            $table->index('customer_id');
            $table->index('payment_type');
            $table->index('status');
            $table->index('created_at');
            $table->index('deleted_at');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
