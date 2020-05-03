@extends('layouts.app')

@section('title', 'Posts')

@section('content')
	<div class="title-content-form">
		<h2>Detalle del Post</h2>
	</div>
	<div class="conten-form">	
		{!!Form::model($post, ['route'=> ['posts.update', $post->id], 'method'=>'PUT', 'files'=>true])!!}
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="sub-datos">
					<div class="title-sub-datos">
						<h3>Datos del Post</h3>
					</div>
					<div class="content-sub-datos" style="margin-bottom: -7px;">
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
							<div class="form-group">
								{!!Form::text('title',null,['class'=>'form-control', 'placeholder'=>'Tematica post', 'disabled'=>'true'])!!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
							<div class="form-group">
								<div class="input-group date" id="datetimepicker4" data-target-input="nearest">
									<?php if(!empty($post)){ ?>
			            	<input type="text" name="start" class="form-control datetimepicker-input" data-target="#datetimepicker4" placeholder="Fecha Inicio" value="{!!$post->start!!}" disabled="true" />
			            <?php }else{ ?>
			            	<input type="text" name="start" class="form-control datetimepicker-input" data-target="#datetimepicker4" placeholder="Fecha Inicio" disabled="true" />
			            <?php }?>
			            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
			                <div class="input-group-text" style="border-top-right-radius: 12px;border-bottom-right-radius: 12px;"><i class="fa fa-calendar"></i></div>
			            </div>
				        </div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
							<div class="form-group">
								<div class="input-group date" id="datetimepicker5" data-target-input="nearest">
									<?php if(!empty($post)){ ?>
			            	<input type="text" name="end" class="form-control datetimepicker-input" data-target="#datetimepicker5" placeholder="Fecha Final" value="{!!$post->end!!}" disabled="true" />
			            <?php }else{ ?>
			            	<input type="text" name="end" class="form-control datetimepicker-input" data-target="#datetimepicker5" placeholder="Fecha Final" disabled="true" />
			            <?php }?>
			            <div class="input-group-append" data-target="#datetimepicker5" data-toggle="datetimepicker">
			                <div class="input-group-text" style="border-top-right-radius: 12px;border-bottom-right-radius: 12px;"><i class="fa fa-calendar"></i></div>
			            </div>
				        </div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
							<div class="form-group" style="color: #868686;font-size: 18px;">
								{!!Form::label('editable', 'Editable:')!!}
								{!!Form::radio('editable', 1,null,['disabled'=>'true'])!!} Si
								{!!Form::radio('editable', 0,null,['disabled'=>'true'])!!} No
								<?php 
								if($post->adjunto_editable != 0 && $post->editable == 1){ ?>
									<a target="_blank" href="/editables-graficos/{{$post->adjunto_editable}}" style="color: #fff;background: #c03735;padding: 11.5px 20px;display: block;border-radius: 15px;font-size: 18px;text-align: center;">Descargar editable</a>
								<?php } ?>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 float-left">
							<div class="form-group">
								{!!Form::textarea('asunto',null,['class'=>'form-control', 'placeholder'=>'Asunto', 'disabled'=>'true'])!!}
							</div>
						</div>
					</div>
				</div>
				<?php 
				if($post->adjunto_pieza_grafica != 0){ ?>
				<div class="sub-datos" style="border: 1px solid #c6c6c5;">
					<div class="title-sub-datos">
						<h3>Pieza Grafica</h3>
					</div>
					<a target="_blank" href="/piezas-graficas/{{$post->adjunto_pieza_grafica}}" style="color: #fff;background: #c03735;padding: 15px;display: table;margin: 20px auto;border-radius: 15px;font-size: 19px;">Ver pieza grafica</a>
				</div>
				<?php } ?>
				<div class="sub-datos">
					<div class="title-sub-datos">
						<h3>Datos de la Pauta</h3>
					</div>
					<div class="content-sub-datos" style="margin-bottom: -7px;">
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
							<div class="form-group">
								{!!Form::select('tipo_post',['Organico'=>'Organico','Pago'=>'Pago'], null,['class'=>'form-control', 'placeholder'=>'Tipos post', 'disabled'=>'true'])!!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
							<div class="form-group">
								{!!Form::text('inversion_inicial',null,['class'=>'form-control', 'placeholder'=>'Inversión', 'disabled'=>'true'])!!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
							<div class="form-group">
								{!!Form::text('ciudades_post',null,['class'=>'form-control', 'placeholder'=>'Ciudades separadas por coma (,)', 'disabled'=>'true'])!!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
							<div class="form-group">
								{!!Form::select('formato_post',['Jpg'=>'Jpg','Video'=>'Video','Secuencua'=>'Secuencua','Canvas'=>'Canvas'], null,['class'=>'form-control', 'placeholder'=>'Formato de post', 'disabled'=>'true'])!!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
							<div class="form-group">
								{!!Form::select('genero_post',['Mujeres'=>'Mujeres','Hombres'=>'Hombres','Mujeres y Hombres'=>'Mujeres y Hombres'], null,['class'=>'form-control', 'placeholder'=>'Genero', 'disabled'=>'true'])!!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float-left">
							<div class="form-group">
								{!!Form::select('edades_post',['23 a 52'=>'23 a 52','20 a 55'=>'20 a 55','18 a 55'=>'18 a 55'], null,['class'=>'form-control', 'placeholder'=>'Edades', 'disabled'=>'true'])!!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-left">
							<div class="form-group">
								{!!Form::textarea('describir_detalles_post',null,['class'=>'form-control', 'placeholder'=>'Describir detalles de post', 'disabled'=>'true'])!!}
							</div>
						</div>
					</div>
				</div>
			</div>
			{!!Form::hidden('id_usuario', Auth::id())!!}
			<input type="hidden" name="fase_post" value="0">
			<?php if(!empty($idplaneacion)){ ?>
				<input type="hidden" name="id_planeacion" value="<?php echo $idplaneacion; ?>">
			<?php }?>
			{!!Form::hidden('estado', 'en-espera')!!}
		</div>
		{!!Form::close()!!}
		<div class="text-center" style="margin-top:20px;width: 100%;">
			<a href="/posts/<?php echo $post->id_planeacion; ?>/listado-posts" style="color: #fff;" class="btn-accion"><i class="fas fa-chevron-circle-left"></i> Volver</a>
		</div>
	</div>
@stop