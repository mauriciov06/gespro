<?php

namespace Gespro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Planeacion extends Model
{
	use SoftDeletes;

  protected $table = 'planeacions';
  protected $dates = ['deleted_at'];

  protected $fillable = ['id_usuario','nombre_planeacion','tipo_servicio', 'start','end', 'momentos', 'archivo_adjunto', 'inversion_inicial', 'inversion_final', 'ciudades_planeacion', 'edades_planeacion', 'detalles_planeacion', 'numero_post','estado'];

  public function scopeBusquedaPlaneacion($query, $name_plan, $servicio, $estado){
    if(trim($name_plan) != ''){
      return $query->where('nombre_planeacion', 'LIKE', "%$name_plan%");
    }elseif($servicio != ''){
      return $query->where('tipo_servicio', $servicio);
    }elseif($estado != ''){
      return $query->where('estado', $estado);
    }
  }
}
