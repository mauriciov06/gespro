@extends('layouts.app')

@section('title', 'Contactos')

@section('content')
	<div class="title-content-form">
		<h2>Listado de contactos</h2>
	</div>
	<div class="conten-form">	
		<div class="p-0">
			<form method="GET" action="/contactos/<?php echo $idcliente; ?>/listado-contactos" accept-charset="UTF-8" role="search">
			  <div class="input-group search_filter">
			  	<div class="input-group">
			    	@include('search.search_contacto_cliente')
			    	<button type="submit" class="btn btn-search">
			    		<i class="fas fa-search"></i>
			    	</button>
			    	<a id="button-clear-search">Limpiar</a>
			    </div>
			  </div>
			</form>
		</div>
		<table class="table table-sty">
			<thead>
				<th>Nombre Completo</th>
				<th>Correo Electronico</th>
				<th>Celular</th>
				<th>Telefono</th>
				<th>Acción</th>
			</thead>
			<?php 
				$array = json_decode( json_encode( $contactos ), true ); 
			?>
			@if($array['total'] != 0)
				@foreach($contactos as $contacto)
				<tbody>
					<td class="first-item-table">{{$contacto->name}}</td>
					<td>{{$contacto->email}}</td>
					<td>{{$contacto->celular_usuario}}</td>
					<td>{{$contacto->telefono_usuario}}</td>
					<td class="acciones-btns">
						<div class="btn-group" role="group" aria-label="Basic example">
							<a class="btn-editar" href="/contactos/<?php echo $contacto->id_cliente; ?>/contacto-cliente/{{$contacto->id}}/edit" data-toggle="tooltip" data-placement="top" title="Editar">
							<i class="far fa-edit"></i>
							</a>
							<a class="btn-eliminar" data-toggle="modal" data-target="#modaleliminar" data-toggle="tooltip" data-placement="top" title="Eliminar" data-ideliminar="{{$contacto->id}}">
								<i class="far fa-trash-alt"></i>
							</a>
						</div>
					</td>
				</tbody>
				@endforeach
			@else
				<tbody>
					<td colspan="6">
						<div class="alert alert-primary" role="alert">No hay contactos creados para este cliente.</div>
					</td>
				</tbody>
			@endif
		</table>
		<div class="text-center">
			{!!$contactos->appends(Request::only(['nombre_contacto_cli','correo_contacto_cli']))->render()!!}
		</div>
		<div class="text-center">
			<a href="/clientes" style="color: #fff;" class="btn-accion"><i class="fas fa-chevron-circle-left"></i> Volver</a>
		</div>
	</div>
@stop

@section('scripts')
	{!!Html::script('js/custom-file-input.js')!!}
@endsection