<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->string('name'); // Nombre del usuario
            $table->string('email')->unique(); // Email único
            $table->timestamp('email_verified_at')->nullable(); // Verificación de email opcional
            $table->string('password'); // Contraseña
            $table->rememberToken(); // Token de "Recordar sesión"
            $table->timestamps(); // Timestamps (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
