@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
	<div class="title-content-form">
		<h2>Listado de Usuarios</h2>
	</div>

	<div class="conten-form">	
		<div class="p-0">
			{!!Form::model(Request::all(), ['route'=>'usuarios.index', 'method'=>'GET', 'role'=>'search'])!!}
			  <div class="input-group search_filter">
			  	<div class="input-group">
			    	@include('search.search_usuario')
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
				<th>Nombre Completo</th>
				<th>Correo Electronico</th>
				<th>Celular</th>
				<th>Ciudad</th>
				<th>Acciones</th>
			</thead>
			<?php 
				$array = json_decode( json_encode( $usuarios ), true ); 
			?>
			@if($array['total'] != 0)
				@foreach($usuarios as $usuario)
				<tbody>
					<td class="first-item-table">{{$usuario->name}}</td>
					<td>{{$usuario->email}}</td>
					<td>{{$usuario->celular_usuario}}</td>
					<td>
						<?php 
							$ciudads = json_decode($ciudades, true);
							foreach ($ciudads as $id_ciudad => $nombreCiudad) {
								if($id_ciudad == $usuario->ciudad_usuario){
									echo $nombreCiudad;
								}
							}
						?>
					</td>
					<td class="acciones-btns">
						<div class="btn-group" role="group" aria-label="Basic example">
							<a class="btn-editar" href="/usuarios/{{$usuario->slug}}/edit" data-toggle="tooltip" data-placement="top" title="Editar">
								<i class="far fa-edit"></i>
							</a>
							<a class="btn-eliminar" data-toggle="modal" data-target="#modaleliminar" data-toggle="tooltip" data-placement="top" title="Eliminar" data-ideliminar="{{$usuario->id}}">
								<i class="far fa-trash-alt"></i>
							</a>
						</div>
					</td>
				</tbody>
				@endforeach
			@else
				<tbody>
					<td colspan="6">
						<div class="alert alert-primary" role="alert">No hay usuarios creados.</div>
					</td>
				</tbody>
			@endif
		</table>
		<div class="text-center">
			{!!$usuarios->appends(Request::only(['nombre_usuario','correo_usuario','ciudad_usuario']))->render()!!}
		</div>
	</div>
@endsection