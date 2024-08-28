<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $user = User::create([
            'name' => 'Departamento de Escolares',
            'email' => 'escolares@sjuanrio.tecnm.mx',
            'password' => Hash::make('12345678'),
        ]);

        $user = User::create([
            'name' => 'División de estudios profesionales',
            'email' => 'div_estudios@sjuanrio.tecnm.mx',
            'password' => Hash::make('12345678'),
        ]);
    }

    /* Relacion 1 - 1 */

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('users');
    }
};
