@extends('layouts.app')

@section('title', 'Planeaciones')

@section('content')
	<div class="title-content-form">
		<h2>Listado de Planeaciones</h2>
	</div>

	<div class="conten-form">	
		<div class="p-0">
			{!!Form::model(Request::all(), ['route'=>'planeaciones.index', 'method'=>'GET', 'role'=>'search'])!!}
			  <div class="input-group search_filter">
			  	<div class="input-group">
			    	@include('search.search_planeacion')
			    	<button type="submit" class="btn btn-search">
			    		<i class="fas fa-search"></i>
			    	</button>
			    	<a id="button-clear-search">Limpiar</a>
			    </div>
			  </div>
			{!!Form::close()!!}
		</div>
		<table class="table table-sty">
			<thead>
				<th>Nombre Planeación</th>
				<th>Fecha de Inicio</th>
				<th>Fecha de Finalización</th>
				<th>Inversión</th>
				<th>Estado</th>
				<th>Acciones</th>
			</thead>
			<?php 
				$array = json_decode( json_encode( $planeaciones ), true ); 
			?>
			@if($array['total'] != 0)
				@foreach($planeaciones as $planeacion)
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
					<td>
						<?php
							echo '$'.number_format($planeacion->inversion_inicial);

						?>
					</td>
					<td>
						<?php
							$estado_in = ''; 
							if($planeacion->estado == 'en-espera'){
								$estado_in = 'En espera';
							}elseif($planeacion->estado == 'Aprobado'){
								$estado_in = 'Aprobado';
							}else{
								$estado_in = 'Rechazada';
							}

							echo $estado_in;
						?>
					</td>
					<td class="acciones-btns">
						<div class="btn-group" role="group" aria-label="Basic example">
							<a class="btn-estadisticas" href="/estadisticas/planeacion/{{$planeacion->id}}" data-toggle="tooltip" data-placement="top" title="Ver estadisticas"><i class="fas fa-chart-bar"></i></a>
							<a class="btn-revisiones" href="/revisiones/{{$planeacion->id}}" data-toggle="tooltip" data-placement="top" title="Revisiones"><i class="fas fa-clipboard-list"></i></a>
							<a class="btn-contacto" href="/posts/{{$planeacion->id}}/crear-post" data-toggle="tooltip" data-placement="top" title="Crear Post"><i class="far fa-times-circle" style="transform: rotate(45deg);"></i></a>
							<a class="btn-contacto" href="/posts/{{$planeacion->id}}/listado-posts" data-toggle="tooltip" data-placement="top" title="Listado de Posts"><i class="fas fa-list-ul"></i></a>
							<a class="btn-editar" href="/planeaciones/{!!$planeacion->id!!}/edit" data-toggle="tooltip" data-placement="top" title="Editar">
								<i class="far fa-edit"></i>
							</a>
							<a class="btn-eliminar" data-toggle="modal" data-target="#modaleliminar" data-toggle="tooltip" data-placement="top" title="Eliminar" data-ideliminar="{!!$planeacion->id!!}">
								<i class="far fa-trash-alt"></i>
							</a>
						</div>
					</td>
				</tbody>
				@endforeach
			@else
				<tbody>
					<td colspan="6">
						<div class="alert alert-primary" role="alert">No hay planeaciones creadas.</div>
					</td>
				</tbody>
			@endif
		</table>
		<div class="text-center">
			{!!$planeaciones->appends(Request::only(['nombre_plan','servicio_plan','estado_plan']))->render()!!}
		</div>
	</div>
@endsection