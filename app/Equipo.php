<?php

namespace Gespro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipo extends Model
{
	use SoftDeletes;

  protected $table = 'equipos';
  protected $dates = ['deleted_at'];

  protected $fillable = ['nombre_equipo'];

  public function scopeBusquedaEquipo($query, $name){
    if(trim($name) != ''){
      return $query->where('nombre_equipo', 'LIKE', "%$name%");
    }
  }
}
