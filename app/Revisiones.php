<?php

namespace Gespro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Revisiones extends Model
{
	use SoftDeletes;
	
	protected $table = 'revisiones';
	protected $dates = ['deleted_at'];

  protected $fillable = ['id_usuario','id_planeacion','id_post','tipo_revision','razon_desaprobacion','fase_revision','estado'];
}
