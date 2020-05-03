<?php

namespace Gespro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
	use SoftDeletes;

	protected $table = 'posts';
	protected $dates = ['deleted_at'];

  protected $fillable = ['id_planeacion','title','start', 'end', 'editable', 'adjunto_editable', 'asunto', 'tipo_post', 'inversion_inicial', 'inversion_final', 'ciudades_post', 'formato_post','genero_post','edades_post', 'describir_detalles_post', 'adjunto_pieza_grafica','fase_post','estado'];

  public function scopeBusquedaPost($query, $name_post, $tipo_ps){
    if(trim($name_post) != ''){
      return $query->where('title', 'LIKE', "%$name_post%");
    }elseif($tipo_ps != ''){
      return $query->where('tipo_post', $tipo_ps);
    }
  }

}
