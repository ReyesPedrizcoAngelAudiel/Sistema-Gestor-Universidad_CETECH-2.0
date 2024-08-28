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
        Schema::create('grupos', function (Blueprint $table) {
            $table->id()->unique();
            $table->unsignedBigInteger('periodo_id')->nullable(false); //foranea
            $table->unsignedBigInteger('plan_estudio_id')->nullable(false); //foranea
            $table->unsignedBigInteger('materia_id')->nullable(false); //foranea
            $table->tinyInteger('semestre')->nullable(false);
            $table->char('letra_grupo',3)->nullable(false);
            $table->tinyInteger('capacidad')->nullable(false);
            $table->unsignedBigInteger('docente_id')->nullable(false); //foranea

            //creando relaciones
            $table->foreign('periodo_id')
                ->references('id')->on('periodos');

            $table->foreign('plan_estudio_id')
                ->references('id')->on('planes_estudio');

            $table->foreign('materia_id')
                ->references('id')->on('materias');
            
            $table->foreign('docente_id')
                ->references('id')->on('docentes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
