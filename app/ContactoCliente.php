<?php

namespace Gespro;

use Illuminate\Database\Eloquent\Model;

class ContactoCliente extends Model
{
  protected $table = 'contacto_clientes';

  protected $fillable = ['id_cliente','id_contactocliente'];

  
}
