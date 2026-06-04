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
        Schema::create('accesos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_requerimiento')->unique();
            $table->foreignId('area_id')
                  ->constrained('areas')
                  ->restrictOnDelete();
            $table->foreignId('responsable_id')
                  ->constrained('responsables')
                  ->restrictOnDelete();
            $table->enum('estado', ['ACTIVO', 'FINALIZADO'])->default('ACTIVO');
            $table->timestamp('check_out')->nullable();
            $table->softDeletes();
            $table->timestamps();
        
            $table->index('estado');
            $table->index(['area_id', 'estado']);
            $table->index('responsable_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accesos');
    }
};
