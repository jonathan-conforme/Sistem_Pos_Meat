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
        Schema::create('customers', function (Blueprint $table) {
           $table->id();
            $table->string('name');
            $table->string('cedula', 15)->unique();
            $table->string('email', 255)->nullable();
            $table->string('phone', 15);
            $table->string('address', 255);
            $table->text('comments')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('is_final_consumer')->default(false);
            $table->timestamps();
            $table->softDeletes();
            
            // Índices para mejor performance
            $table->index('cedula');
            $table->index('is_final_consumer');
            $table->index('deleted_at');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
