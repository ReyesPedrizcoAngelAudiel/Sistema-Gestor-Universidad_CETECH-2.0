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
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_control');
            $table->string('nombre_alumno');
            $table->string('ap_paterno');
            $table->string('ap_materno');
            $table->string('curp');
            $table->unsignedBigInteger('plan_id');
            $table->integer('semestre');
            $table->unsignedBigInteger('estatus_id');
            $table->unsignedBigInteger('tipoA_id');
            $table->unsignedBigInteger('user_id');
            
            //Llave foranea de "plan_estudio"
            $table->foreign('plan_id')
                ->references('id')->on('planes_estudio');
            //Llave foranea de "estatus_id"
            $table->foreign('estatus_id')
                ->references('id')->on('estatus');
            //Llave foranea de "tipoA_id"
            $table->foreign('tipoA_id')
                ->references('id')->on('tipos_alumno');
            //Llave foranea de "user_id"
            $table->foreign('user_id')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
