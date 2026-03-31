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
    Schema::create('empresas', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('razon_social');
        $table->string('ruc')->unique();
        $table->string('matriz');
        $table->string('sucursal');
        $table->string('telefono');
        $table->string('email');
        $table->string('obligado_contabilidad');
        $table->string('tipo_ruc');
        $table->string('contribuyente_especial')->nullable();
        $table->string('logo')->nullable();
        $table->timestamps();
    });
}

/**
 * Reverse the migrations.
 */
public function down(): void
{
        Schema::dropIfExists('empresas');
    }
};
