<?php

namespace Gespro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ciudad extends Model
{
	use SoftDeletes;

  protected $table = 'ciudads';
  protected $dates = ['deleted_at'];

  protected $fillable = ['nombre_ciudad'];
}
