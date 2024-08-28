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
        Schema::create('estatus', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_estatus',30)->nullable(false);
        });

        DB::table('estatus')->insert([
            ['nombre_estatus' => 'Baja definitiva'],
            ['nombre_estatus' => 'Baja temporal'],
            ['nombre_estatus' => 'Egresado'],
            ['nombre_estatus' => 'Inscrito'],
            ['nombre_estatuso' => 'Reinscrito'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estatus');
    }
};