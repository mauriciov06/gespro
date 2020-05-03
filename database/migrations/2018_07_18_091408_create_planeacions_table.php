<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaneacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planeacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario');
            $table->string('nombre_planeacion');
            $table->string('tipo_servicio');
            $table->dateTime('fecha_final');
            $table->integer('momentos');
            $table->text('archivo_adjunto');
            $table->integer('inversion_inicial');
            $table->integer('inversion_final');
            $table->text('ciudades_planeacion');
            $table->text('edades_planeacion');
            $table->text('detalles_planeacion');
            $table->integer('numero_post');
            $table->string('estado');
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
        Schema::dropIfExists('planeacions');
    }
}
