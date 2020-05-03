<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('posts', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('id_planeacion');
      $table->string('tematica_post');
      $table->dateTime('fecha_inicio');
      $table->dateTime('fecha_final');
      $table->smallInteger('editable');
      $table->text('adjunto_editable');
      $table->text('asunto');
      $table->string('tipo_post');
      $table->integer('inversion_inicial');
      $table->integer('inversion_final');
      $table->text('ciudades_post');
      $table->string('formato_post');
      $table->text('genero_post');
      $table->string('edades_post');
      $table->text('describir_detalles_post');
      $table->text('adjunto_pieza_grafica');
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
    Schema::dropIfExists('posts');
  }
}
