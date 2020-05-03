@extends('layouts.app')

@section('title', 'Usuario')

@section('content')
	<div class="title-content-form">
		<h2>Editar Usuario</h2>
	</div>
	<div class="conten-form">	
		{!!Form::model($usuario, ['route'=> ['usuarios.update', $usuario], 'method'=>'PUT', 'files'=>true])!!}
		<div class="row">
			@include('usuario.forms.usr')
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
				{!!Form::submit('Editar Usuario',['class'=>'btn btn-accion'])!!}
			</div>
		</div>
		{!!Form::close()!!}
	</div>
@stop

@section('scripts')
	{!!Html::script('js/custom-file-input.js')!!}
@endsection