@extends('layouts.app')

@section('title', 'Cliente')

@section('content')
	<div class="title-content-form">
		<h2>Listado de Clientes</h2>
	</div>

	<div class="conten-form">	
		<div class="p-0">
			{!!Form::model(Request::all(), ['route'=>'clientes.index', 'method'=>'GET', 'role'=>'search'])!!}
			  <div class="input-group search_filter">
			  	<div class="input-group">
			    	@include('search.search_cliente')
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
				$array = json_decode( json_encode( $clientes ), true ); 
			?>
			@if($array['total'] != 0)
				@foreach($clientes as $cliente)
				<tbody>
					<td class="first-item-table">{{$cliente->name}}</td>
					<td>{{$cliente->email}}</td>
					<td>{{$cliente->celular_usuario}}</td>
					<td>
						<?php 
							$ciudads = json_decode($ciudades, true);
							foreach ($ciudads as $id_ciudad => $nombreCiudad) {
								if($id_ciudad == $cliente->ciudad_usuario){
									echo $nombreCiudad;
								}
							}
						?>
					</td>
					<td class="acciones-btns">
						<div class="btn-group" role="group" aria-label="Basic example">
							<a class="btn-contacto" href="/contactos/{{$cliente->id}}/crear-contacto" data-toggle="tooltip" data-placement="top" title="Crear Contacto"><i class="far fa-times-circle" style="transform: rotate(45deg);"></i></a>
							<?php $countcontactos = DB::table('users')->where('id_cliente',$cliente->id)->where('deleted_at','=',null)->count(); 
							if($countcontactos > 0){?>
								<a class="btn-contacto" href="/contactos/{{$cliente->id}}/listado-contactos" data-toggle="tooltip" data-placement="top" title="Listado de Contactos"><i class="fas fa-list-ul"></i></a>
							<?php } ?>
							<a class="btn-editar" href="/clientes/{{$cliente->slug}}/edit" data-toggle="tooltip" data-placement="top" title="Editar">
								<i class="far fa-edit"></i>
							</a>
							<a class="btn-eliminar" data-toggle="modal" data-target="#modaleliminar" data-toggle="tooltip" data-placement="top" title="Eliminar" data-ideliminar="{{$cliente->id}}">
								<i class="far fa-trash-alt"></i>
							</a>
						</div>
					</td>
				</tbody>
				@endforeach
			@else
				<tbody>
					<td colspan="6">
						<div class="alert alert-primary" role="alert">No hay clientes creados.</div>
					</td>
				</tbody>
			@endif
		</table>
		<div class="text-center">
			{!!$clientes->appends(Request::only(['nombre_cliente','correo_cliente','ciudad_cliente','tipo_cuenta_cliente']))->render()!!}
		</div>
	</div>
@stop

@section('scripts')
	{!!Html::script('js/custom-file-input.js')!!}
@endsection