@extends('layouts.app')

@section('title', 'Equipos')

@section('content')
	<div class="title-content-form">
		<h2>Listado de Equipos</h2>
	</div>
	
	<div class="conten-form">	
		<div class="p-0">
			{!!Form::model(Request::all(), ['route'=>'equipos.index', 'method'=>'GET', 'role'=>'search'])!!}
			  <div class="input-group search_filter">
			  	<div class="input-group">
			  		<a id="btn-crear-equipo" data-toggle="modal" data-target="#modalequipo"><i class="far fa-times-circle"></i> Crear Equipo</a>
			    	@include('search.search_equipo')
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
				<th style="text-align: left;">Nombre Equipo</th>
				<th style="text-align: right;">Acciones</th>
			</thead>
			<?php 
				$array = json_decode( json_encode( $equipos ), true ); 
			?>
			@if($array['total'] != 0)
				@foreach($equipos as $equipo)
					<tbody>
						<td style="text-align: left;">{{$equipo->nombre_equipo}}</td>
						<td class="acciones-btns" style="text-align: right;">
							<div class="btn-group" role="group" aria-label="Basic example">
								<a class="btn-editar btn-editar-equipo" data-toggle="modal" data-target="#modalequipo" data-toggle="tooltip" data-placement="top" title="Editar" data-ideditarequipo="{{$equipo->id}}">
									<i class="far fa-edit"></i>
								</a>
								<a class="btn-eliminar" data-toggle="modal" data-target="#modaleliminar" data-toggle="tooltip" data-placement="top" title="Eliminar" data-ideliminar="{{$equipo->id}}">
									<i class="far fa-trash-alt"></i>
								</a>
							</div>
						</td>
					</tbody>
				@endforeach
			@else
				<tbody>
					<td colspan="6">
						<div class="alert alert-primary" role="alert">No hay equipos creados.</div>
					</td>
				</tbody>
			@endif
		</table>
		<div class="text-center">
			{!!$equipos->appends(Request::only(['nombre_equipo']))->render()!!}
		</div>
	</div>
@endsection