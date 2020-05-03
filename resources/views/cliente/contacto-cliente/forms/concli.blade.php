<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
		<div class="form-group">
			{!!Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Nombre completo'])!!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
		<div class="form-group">
			{!!Form::text('email',null,['class'=>'form-control', 'placeholder'=>'Correo Electrónico'])!!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
		<div class="form-group">
			{!!Form::text('celular_usuario',null,['class'=>'form-control', 'placeholder'=>'Celular'])!!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
		<div class="form-group">
			{!!Form::select('ciudad_usuario',$ciudades, null,['class'=>'form-control'])!!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
		<div class="form-group">
			{!!Form::text('telefono_usuario',null,['class'=>'form-control', 'placeholder'=>'Teléfono'])!!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
		<div class="form-group">
			{!!Form::text('cargo_usuario',null,['class'=>'form-control', 'placeholder'=>'Cargo'])!!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left">
		<div class="form-group">
			{!!Form::password('password',['class'=>'form-control', 'placeholder'=>'Contraseña'])!!}
		</div>
	</div>
	{!!Form::hidden('tipo_cuenta','4')!!}
</div>

<input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">

<input type="hidden" name="direccion_usuario" value="0">
<input type="hidden" name="avatar" value="0">
<input type="hidden" name="nit_rut" value="0">
<input type="hidden" name="id_equipo" value="-1">
