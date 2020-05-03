{!!Form::text('nombre_cliente',null,['id'=>'nombre_usu', 'class'=>'form-control', 'placeholder'=>"Nombre del cliente"])!!}
{!!Form::text('correo_cliente',null,['id'=>'correo_usu', 'class'=>'form-control', 'placeholder'=>"Correo del cliente"])!!}
{!!Form::select('ciudad_cliente',$ciudades, null, ['id'=>'ciudad_usu', 'class'=>'form-control', 'placeholder'=>"Seleccionar ciudad"])!!}
{!!Form::select('tipo_cuenta_cliente',['2'=>'Individual','3'=>'Empresarial'], null, ['id'=>'tipo_cuen', 'class'=>'form-control', 'placeholder'=>"Tipo cliente"])!!}