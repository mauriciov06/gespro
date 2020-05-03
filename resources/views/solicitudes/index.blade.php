@extends('layouts.app')

@section('title', 'Solicitudes')

@section('content')
	<div class="title-content-form">
		<h2>Listado de Solicitudes</h2>
	</div>

	<div class="conten-form">	
		<div class="p-0">
			{!!Form::model(Request::all(), ['route'=>'solicitudes.index', 'method'=>'GET', 'role'=>'search'])!!}
			  <div class="input-group search_filter">
			  	<div class="input-group">
			    	@include('search.search_solicitudes')
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
				<th style="text-align: left;">Nombre de Solicitud</th>
				<th>Tema de Urgencia</th>
				<th>Acciones</th>
			</thead>
			<?php 
				$array = json_decode( json_encode( $solicitudes ), true ); 
			?>
			@if($array['total'] != 0)
				@foreach($solicitudes as $solicitud)
				<tbody>
					<td class="first-item-table" style="text-align: left;">{{$solicitud->nombre_solicitud}}</td>
					<td>
						<?php 
							$temas_urgens = json_decode($temas_urgencias, true);
							foreach ($temas_urgens as $id_tema_urgen => $nombretema) {
								if($id_tema_urgen == $solicitud->tema_urgencia){
									echo $nombretema;
								}
							}
						?>
					</td>
					<td class="acciones-btns">
						<div class="btn-group" role="group" aria-label="Basic example">
							<a class="btn-contacto" href="/solicitudes/{{$solicitud->id}}" data-toggle="tooltip" data-placement="top" title="Ver solicitud">
								<i class="fas fa-eye"></i>
							</a>
							<a class="btn-editar" href="/solicitudes/{{$solicitud->id}}/edit" data-toggle="tooltip" data-placement="top" title="Editar">
								<i class="far fa-edit"></i>
							</a>
							<a class="btn-eliminar" data-toggle="modal" data-target="#modaleliminar" data-toggle="tooltip" data-placement="top" title="Eliminar" data-ideliminar="{{$solicitud->id}}">
								<i class="far fa-trash-alt"></i>
							</a>
						</div>
					</td>
				</tbody>
				@endforeach
			@else
				<tbody>
					<td colspan="6">
						<div class="alert alert-primary" role="alert">No hay Solicitudes creados.</div>
					</td>
				</tbody>
			@endif
		</table>
		<div class="text-center">
			{!!$solicitudes->appends(Request::only(['nombre_soli','tema_urge']))->render()!!}
		</div>
	</div>
@endsection