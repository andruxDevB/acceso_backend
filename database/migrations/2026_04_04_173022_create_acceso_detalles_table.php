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
        Schema::create('acceso_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requerimiento_id')->constrained('accesos')->cascadeOnDelete();
            $table->string('nombre_persona');
            $table->string('apellido_persona');
            $table->string('cedula_persona');
            $table->string('empresa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acceso_detalles');
    }
};
