@extends('layouts.app')

@section('title', 'Revisiones')

@section('content')
	<div class="title-content-form">
		<h2>Fases de Revisiones</h2>
	</div>
	<div class="conten-form">	
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="sub-datos">
					<div class="title-sub-datos">
						<h3>Fase 1 - Entrega de Planeación</h3>
					</div>
					<div class="content-sub-datos" style="margin-bottom: -7px;">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-left">
							<table class="table table-sty">
								<thead>
									<th>Nombre Planeación</th>
									<th>Fecha de Inicio</th>
									<th>Fecha de Finalización</th>
									<th>Nº Post</th>
									<th>Acciones</th>
								</thead>
								<tbody>
									<td class="first-item-table">{!!$planeacion->nombre_planeacion!!}</td>
									<td>
										<?php 
											$fecha_fin = date("d/m/Y",strtotime($planeacion->start)); 
											echo $fecha_fin;
										?>
									</td>
									<td>
										<?php 
											$fecha_fin = date("d/m/Y",strtotime($planeacion->end)); 
											echo $fecha_fin;
										?>
									</td>
									<td><?php echo $num_post; ?></td>
									<td class="acciones-btns">
										<div class="btn-group group-{!!$planeacion->id!!}" role="group" aria-label="Basic example">
											@if($planeacion->estado == 'en-espera' || $planeacion->estado == 'desaprobado')
												<form style="display: inline-block;" id="form-{!!$planeacion->id!!}">
													<a data-typeoption="planeacion" data-faseaproved="entrega-planeacion" data-idaproved="{!!$planeacion->id!!}" style="margin-right: 0;" class="btn-revisiones btn-aproved" data-toggle="tooltip" data-placement="top" title="Aprobar Planeación"><i class="far fa-check-circle"></i></a>
												</form>
												<a data-typeoption="planeacion" data-idreproved="{!!$planeacion->id!!}" data-faseoption="entrega-planeacion" class="btn-eliminar btn-reproved" data-toggle="modal" data-target="#desaprobacion-modal"><i class="far fa-times-circle"></i></a>
											@else
												<div class='alert alert-success' role='alert' style='margin-bottom: 0;font-size: 14px;padding: 5px 15px;border-radius: 12px;'>Aprobado</div>
											@endif
										</div>
									</td>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="sub-datos">
					<div class="title-sub-datos">
						<h3>Fase 2 - Copys</h3>
					</div>
					<div class="content-sub-datos" style="margin-bottom: -7px;">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-left">
							<table class="table table-sty">
								<thead>
									<th>Nombre Post</th>
									<th style="text-align: left;">Asunto</th>
									<th>Acciones</th>
								</thead>
								@foreach($posts as $post)
									@if($post->fase_post == 'en-espera' && $planeacion->estado == 'Aprobado')
										<tbody>
											<td class="first-item-table">{!!$post->title!!}</td>
											<td style="text-align: left;">{!!$post->asunto!!} <a data-idpostasunto="{!!$post->id!!}" data-toggle="modal" data-target="#verasunto" style="color:#c03734;font-weight: bold;cursor: pointer;" class="verasunto_modal">Ver más</a><div id="mensaje-aproved-{!!$post->id!!}"></div></td>
											<td class="acciones-btns">
												<div class="btn-group group-{!!$post->id!!}" role="group" aria-label="Basic example">
													<form style="display: inline-block;" id="form-{!!$post->id!!}">
														<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
														<a data-typeoption="post" data-idaproved="{!!$post->id!!}" data-faseaproved="copys" data-fasenextaproved="pieza-espera" style="margin-right: 0;" class="btn-revisiones btn-aproved" data-toggle="tooltip" data-placement="top" title="Aprobar Post"><i class="far fa-check-circle"></i></a>
													</form>
													<a data-typeoption="post" data-idreproved="{!!$post->id!!}" data-faseoption="copys" class="btn-eliminar btn-reproved" data-toggle="modal" data-target="#desaprobacion-modal"><i class="far fa-times-circle"></i></a>
												</div>
											</td>
										</tbody>
									@endif
								@endforeach
							</table>
						</div>
					</div>
				</div>
				<div class="sub-datos">
					<div class="title-sub-datos">
						<h3>Fase 3 - Diseño de Piezas</h3>
					</div>
					<div class="content-sub-datos" style="margin-bottom: -7px;">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-left">
							<table class="table table-sty">
								<thead>
									<th>Nombre Post</th>
									<th>Pieza Grafica</th>
									<th>Acciones</th>
								</thead>
								@foreach($posts as $post)
									<tbody>
										@if($post->fase_post == 'pieza-espera')
											<td class="first-item-table">{!!$post->title!!}</td>
											@if($post->adjunto_pieza_grafica != 0)
												<td><a target="_blank" href="/piezas-graficas/{!!$post->adjunto_pieza_grafica!!}" style="background: #c03734;font-weight: bold;color: #fff;padding: 10px 30px;border-radius: 12px;">Ver pieza grafica</a><div id="mensaje-aproved-{!!$post->id!!}"></div></td></td>
											@else
												<td>No se ha subido la pieza grafica en este post</td>
											@endif

											<td class="acciones-btns">
												<div class="btn-group group-{!!$post->id!!}" role="group" aria-label="Basic example">
													@if($post->adjunto_pieza_grafica != 0)
														<form style="display: inline-block;" id="form-{!!$post->id!!}">
															<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
															<a data-fasenextreproved="publicacion" data-typeoption="post" data-idaproved="{!!$post->id!!}" data-faseaproved="diseno-pieza" style="margin-right: 0;" class="btn-revisiones btn-aproved" data-toggle="tooltip" data-placement="top" title="Aprobar Post"><i class="far fa-check-circle"></i></a>
														</form>
														<a data-typeoption="post" data-idreproved="{!!$post->id!!}" data-faseoption="diseno-pieza" class="btn-eliminar btn-reproved" data-toggle="modal" data-target="#desaprobacion-modal"><i class="far fa-times-circle"></i></a>
													@else
														<a data-idplane="{!!$planeacion->id!!}" data-idpos="{!!$post->id!!}" style="margin-right: 0;" class="btn-envio-desaprovad btn-contacto" data-toggle="modal" data-target="#enviodesaprovad-modal"><i class="far fa-envelope-open"></i></a>
													@endif
												</div>
											</td>
										@endif
									</tbody>
								@endforeach
							</table>
						</div>
					</div>
				</div>
				<div class="sub-datos">
					<div class="title-sub-datos">
						<h3>Fase 4 - Publicación</h3>
					</div>
					<div class="content-sub-datos" style="margin-bottom: -7px;">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 float-left">
							<table class="table table-sty">
								<thead>
									<th>Nombre Post</th>
									<th>Fecha de Inicio</th>
									<th>Fecha de Finalización</th>
									<th>Estado</th>
								</thead>
								@foreach($posts as $post)
								<tbody>
									@if($post->fase_post == 'Publicar' || $post->fase_post == 'Programar' || $post->fase_post == 'Vencido')
										<td class="first-item-table">{!!$post->title!!}</td>
										<td>
											<?php 
												$fecha_fin = date("d/m/Y",strtotime($post->start)); 
												echo $fecha_fin;
											?>
										</td>
										<td>
											<?php 
												$fecha_fin = date("d/m/Y",strtotime($post->end)); 
												echo $fecha_fin;
											?>
										</td>
										<td>{!!$post->fase_post!!}</td>
									@endif
								</tbody>
								@endforeach
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="text-center" style="margin-top:20px;width: 100%;">
			<a href="/planeaciones" style="color: #fff;" class="btn-accion"><i class="fas fa-chevron-circle-left"></i> Volver</a>
		</div>
	</div>
@endsection