<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesUrgentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes_urgentes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario');
            $table->string('tema_urgencia');
            $table->string('nombre_solicitud');
            $table->text('descripcion_solicitud');
            $table->string('archivo_adjunto_solicitud');
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
        Schema::dropIfExists('solicitudes_urgentes');
    }
}
