<?php

namespace Gespro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolicitudesUrgentes extends Model
{
	use SoftDeletes;

  protected $table = 'solicitudes_urgentes';
  protected $dates = ['deleted_at'];

  protected $fillable = ['id_usuario','tema_urgencia','nombre_solicitud','descripcion_solicitud','archivo_adjunto_solicitud', 'estado'];

  public function scopeBusquedaSolicitud($query, $nombre_soli, $tema){
    if(trim($nombre_soli) != ''){
      return $query->where('nombre_solicitud', 'LIKE', "%$nombre_soli%");
    }elseif($tema != ''){
      return $query->where('tema_urgencia', $tema);
    }
  }
}
