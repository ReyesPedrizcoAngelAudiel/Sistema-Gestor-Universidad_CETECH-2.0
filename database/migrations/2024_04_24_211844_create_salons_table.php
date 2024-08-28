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
        Schema::create('salons', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('nombre_salon');
            $table->unsignedBigInteger('edificio_id');

            $table->foreign('edificio_id')
                ->references('id')->on('edificios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
