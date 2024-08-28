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
        Schema::create('alumno_grupos', function (Blueprint $table) {
            $table->id()->unique();
            $table->unsignedBigInteger('alumno_id')->nullable(false); //foranea
            $table->unsignedBigInteger('grupo_id')->nullable(false); //foranea

            //creando relaciones
            $table->foreign('alumno_id')
                ->references('id')->on('alumnos');

            $table->foreign('grupo_id')
                ->references('id')->on('grupos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno_grupos');
    }
};
