@extends('layouts.app')

@section('title', 'Posts')

@section('content')
	<div class="title-content-form">
		<h2>Listado de Posts</h2>
	</div>

	<div class="conten-form">	
		<div class="p-0">
			<form method="GET" action="/posts/<?php echo $idplaneacion; ?>/listado-posts" accept-charset="UTF-8" role="search">
			  <div class="input-group search_filter">
			  	<div class="input-group">
			    	@include('search.search_post')
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
				<th>Nombre Post</th>
				<th>Fecha Inicio</th>
				<th>Fecha Final</th>
				<th>Inversión</th>
				<th>Tipo post</th>
				<th>Acciones</th>
			</thead>
			<?php 
				$array = json_decode( json_encode( $posts ), true ); 
			?>
			@if($array['total'] != 0)
				@foreach($posts as $post)
				<tbody>
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
					<td>
						<?php
							echo '$'.number_format($post->inversion_inicial);

						?>
					</td>
					<td>{!!$post->tipo_post!!}</td>
					<td class="acciones-btns">
						<div class="btn-group" role="group" aria-label="Basic example">
							<a class="btn-contacto" href="/posts/{{$post->id}}" data-toggle="tooltip" data-placement="top" title="Ver Post">
								<i class="fas fa-eye"></i>
							</a>
							<a class="btn-editar" href="/posts/{!!$post->id!!}/edit" data-toggle="tooltip" data-placement="top" title="Editar Post">
								<i class="far fa-edit"></i>
							</a>
							<a class="btn-eliminar" data-toggle="modal" data-target="#modaleliminar" data-toggle="tooltip" data-placement="top" title="Eliminar Post" data-ideliminar="{!!$post->id!!}">
								<i class="far fa-trash-alt"></i>
							</a>
						</div>
					</td>
				</tbody>
				@endforeach
			@else
				<tbody>
					<td colspan="6">
						<div class="alert alert-primary" role="alert">No hay posts creados para esta planeacion.</div>
					</td>
				</tbody>
			@endif
		</table>
		<div class="text-center">
			<input type="hidden" name="id_planeacion" value="<?php echo $idplaneacion; ?>">
			<!-- Paginador -->
			{!!$posts->appends(Request::only(['nombre_post','tipo_post']))->render()!!}
		</div>
		<div class="text-center">
			<a href="/planeaciones" style="color: #fff;" class="btn-accion"><i class="fas fa-chevron-circle-left"></i> Volver</a>
		</div>
	</div>
@endsection