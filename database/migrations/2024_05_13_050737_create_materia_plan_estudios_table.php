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
        Schema::create('materia_plan_estudio', function (Blueprint $table) {
            $table->id()->unique();
            $table->unsignedBigInteger('materia_id');
            $table->unsignedBigInteger('plan_estudio_id');
            $table->foreign('materia_id')->references('id')->on('materias');
            $table->foreign('plan_estudio_id')->references('id')->on('planes_estudio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('materia_plan_estudio');
    }
};
