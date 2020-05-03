<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
		<div class="form-group">
			{!!Form::select('tema_urgencia',$temas_urgencias, null,['class'=>'form-control', 'placeholder'=>'Tema de urgencia'])!!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
		<div class="form-group">
			{!!Form::text('nombre_solicitud',null,['class'=>'form-control', 'placeholder'=>'Nombre de solicitud'])!!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
		<input type="file" name="archivo_adjunto_solicitud" id="files" class="inputfile inputfile-1" style="bottom: 0;height: 50px;width: 100%;" />
		<label for="archivo_adjunto_solicitud" style="max-width: 100%;text-align: center;font-size: 20px;"><span>Adjuntar Archivo</span></label>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-left">
		<div class="form-group">
			{!!Form::textarea('descripcion_solicitud',null,['class'=>'form-control', 'placeholder'=>'Descripción detallada de la solicitud'])!!}
		</div>
	</div>
</div>

{!!Form::hidden('id_usuario', Auth::id())!!}
{!!Form::hidden('estado', 0)!!}