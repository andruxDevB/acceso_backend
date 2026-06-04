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
        Schema::create('personas_acceso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acceso_id')
                  ->constrained('accesos')
                  ->cascadeOnDelete();
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('cedula', 20);
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
