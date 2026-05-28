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
            $table->foreignId('area_id')->constrained('areas')->restrictedOnDelete();
            $table->foreignId('responsable_id')->constrained('responsables')->restrictedOnDelete();
            $table->timestamp('check_in');
            $table->timestamp('check_out')->nullable();
            $table->enum('estado',['ACTIVO','FINALIZADO'])->default('ACTIVO');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['numero_requerimiento','estado']);
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
