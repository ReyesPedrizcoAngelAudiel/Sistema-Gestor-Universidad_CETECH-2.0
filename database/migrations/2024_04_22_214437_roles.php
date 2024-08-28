<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $role1 = Role::create(['name' => 'escolares']);
        $role2 = Role::create(['name' => 'docente']);
        $role3 = Role::create(['name' => 'alumno']);
        $role4 = Role::create(['name' => 'div_estudios']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
