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
        Schema::create('materias', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('clave_materia',10)->nullable(False);
            $table->string('nombre')->nullable(False);
            $table->tinyInteger('creditos')->nullable(False);
        });

        DB::table('materias')->insert([
            ['clave_materia' => 'SCA-1002', 'nombre' => 'Administracion de redes', 'creditos' => '4'],
            ['clave_materia' => 'CSF-2003', 'nombre' => 'Estandares de Ciberseguridad', 'creditos' => '5'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materias');
    }
};
