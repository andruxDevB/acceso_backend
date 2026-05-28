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
            $table->foreignId('acceso_id')->constrained('accesos')->cascadeOnDelete();
            $table->string('nombre_persona', 50);
            $table->string('apellido_persona', 50);
            $table->string('cedula_persona', 10);
            $table->string('empresa', 100);
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
