{!!Form::text('nombre_equipo',null,['id'=>'nombre_equ','class'=>'form-control input-custom-app', 'placeholder'=>'Nombre del equipo'])!!}
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
<div id="msg-equipo"></div>