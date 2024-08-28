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
        Schema::create('periodos', function (Blueprint $table) {
            $table->id()->unique();
            $table->char('clave_periodo',4)->nullable(False);
            $table->string('nombre_periodo')->nullable(False);
            $table->string('estatus')->nullable(False);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('periodos');
    }
};
