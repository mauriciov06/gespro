<?php

namespace Gespro;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
  use Notifiable, SoftDeletes;

  protected $table = 'users';
  protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['tipo_cuenta','name','email','celular_usuario','ciudad_usuario','telefono_usuario','direccion_usuario','cargo_usuario','avatar','nit_rut','password','slug','id_equipo', 'id_cliente'];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password', 'remember_token',
  ];

  public function getRouteKeyName(){
      return 'slug';
  }
  public function setPasswordAttribute($valor){
      if(!empty($valor)){
          $this->attributes['password'] = bcrypt($valor);
      }
  }
  public function scopeBusquedaUsuario($query, $name, $correo, $ciudad){
    if(trim($name) != ''){
      return $query->where('name', 'LIKE', "%$name%");
    }elseif(trim($correo) != ''){
      if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
        return $query->where('email', $correo);
      }
    }elseif($ciudad != ''){
      return $query->where('ciudad_usuario', $ciudad);
    }
  }
  public function scopeBusquedaCliente($query, $name_cliente, $correo_cliente, $ciudad_cliente,$tipo_cuenta_cliente){
    if(trim($name_cliente) != ''){
      return $query->where('name', 'LIKE', "%$name_cliente%");
    }elseif(trim($correo_cliente) != ''){
      if(filter_var($correo_cliente, FILTER_VALIDATE_EMAIL)){
        return $query->where('email', $correo_cliente);
      }
    }elseif($ciudad_cliente != ''){
      return $query->where('ciudad_usuario', $ciudad_cliente);
    }elseif($tipo_cuenta_cliente != ''){
      return $query->where('tipo_cuenta', $tipo_cuenta_cliente);
    }
  }

  public function scopeBusquedaContactocliente($query, $name_contac, $correo_contac){
    if(trim($name_contac) != ''){
      return $query->where('name', 'LIKE', "%$name_contac%");
    }elseif(trim($correo_contac) != ''){
      if(filter_var($correo_contac, FILTER_VALIDATE_EMAIL)){
        return $query->where('email', $correo_contac);
      }
    }
  }
  
}
