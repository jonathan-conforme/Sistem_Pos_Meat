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
        Schema::create('cash_closures', function (Blueprint $table) {
      $table->id();
            $table->date('closure_date');
            $table->time('closure_time')->nullable();
            $table->decimal('initial_cash', 12, 2)->default(0);
            $table->decimal('physical_cash', 12, 2)->default(0);
            $table->decimal('cash_sales', 12, 2)->default(0);
            $table->decimal('card_sales', 12, 2)->default(0);
            $table->decimal('transfer_sales', 12, 2)->default(0);
            $table->decimal('credit_sales', 12, 2)->default(0);
            $table->decimal('total_sales', 12, 2)->default(0);
            $table->decimal('total_profit', 12, 2)->default(0);
            $table->decimal('total_cash', 12, 2)->default(0);
            $table->decimal('expected_cash', 12, 2)->default(0);
            $table->decimal('difference', 12, 2)->default(0);
            $table->integer('sales_count')->default(0);
            $table->decimal('average_ticket', 10, 2)->default(0);
            $table->enum('status', ['pending', 'completed', 'verified'])->default('completed');
            $table->text('observations')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
            
            $table->index('closure_date');
            $table->index('user_id');
            $table->index(['closure_date', 'user_id']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cash_closures');
    }
};
