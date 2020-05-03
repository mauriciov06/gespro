<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('tipo_cuenta');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('celular_usuario');
            $table->integer('ciudad_usuario');
            $table->string('telefono_usuario');
            $table->string('direccion_usuario');
            $table->string('cargo_usuario');
            $table->string('avatar');
            $table->string('nit_rut');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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
