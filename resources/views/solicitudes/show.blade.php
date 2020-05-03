@extends('layouts.app')

@section('title', 'Solicitudes')

@section('content')
	<div class="title-content-form">
		<h2>Detalle de la Solicitud</h2>
	</div>
	<div class="conten-form">	
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
					<div class="form-group">
						<?php 
							$temas_urgens = json_decode($temas_urgencias, true);
							foreach ($temas_urgens as $id_tema_urgen => $nombretema) {
								if($id_tema_urgen == $solicitud->tema_urgencia){ ?>
									<input type="text" name="tema_urgencia" class="form-control" value="<?php echo $nombretema; ?>" disabled>
						<?php 
							}
							 	}
						?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
					<div class="form-group">
						<input type="text" name="nombre_solicitud" class="form-control" value="{{$solicitud->nombre_solicitud}}" disabled>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
					<a class="descargar-ver-archivo" href="/adjuntos-solicitudes/{{$solicitud->archivo_adjunto_solicitud}}" target="_blank">Descargar Archivo</a>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-left">
					<div class="form-group">
						<textarea class="form-control" disabled>{{$solicitud->descripcion_solicitud}}</textarea>
					</div>
				</div>
			</div>
			<div class="text-center" style="margin-top:20px;width: 100%;">
				<a href="/solicitudes" style="color: #fff;" class="btn-accion"><i class="fas fa-chevron-circle-left"></i> Volver</a>
			</div>
		</div>
	</div>
@stop