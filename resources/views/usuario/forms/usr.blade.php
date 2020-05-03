<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group text-center m-0">
			<output id="list" style="padding: 7px 0 7px 0 !important;">
			<?php if(!empty($usuario)){ ?>
				<img class="thumb" src="/avatares/{{$usuario->avatar}}" alt="">
			<?php }else{ ?>
			<img class="thumb" src="/imagenes/avatar-default-users.png" alt="">
			<?php } ?>
			</output>
	  	<input type="file" name="avatar" id="files" class="inputfile inputfile-1" />
			<label for="avatar"><span>Seleccionar avatar</span></label>
		</div>
	</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
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
			{!!Form::select('id_equipo',$equipos, null,['class'=>'form-control'])!!}
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
	{!!Form::hidden('tipo_cuenta','1')!!}
	{!!Form::hidden('id_cliente',0)!!}
</div>