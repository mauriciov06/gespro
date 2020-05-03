<?php

namespace Gespro;

use Illuminate\Database\Eloquent\Model;

class TemasUrgenciaSolicitudes extends Model
{
  protected $table = 'temas_urgencia_solicitudes';

  protected $fillable = ['nombre_tema'];
}
