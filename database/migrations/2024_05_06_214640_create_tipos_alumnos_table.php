<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('tipos_alumno', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_tipo',30)->nullable(false);
        });

        DB::table('tipos_alumno')->insert([
            ['nombre_tipo' => 'Cambio de Carrera'],
            ['nombre_tipo' => 'Convalidación'],
            ['nombre_tipo' => 'Equivalencia'],
            ['nombre_tipo' => 'Equivalencia/Reingreso'],
            ['nombre_tipo' => 'Movilidad'],
            ['nombre_tipo' => 'Nuevo Ingreso'],
            ['nombre_tipo' => 'Re-ingreso'],
            ['nombre_tipo' => 'Revalidación'],
            ['nombre_tipo' => 'Traslado'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_alumnos');
    }
};