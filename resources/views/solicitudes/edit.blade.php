@extends('layouts.app')

@section('title', 'Solicitudes')

@section('content')
	<div class="title-content-form">
		<h2>Editar Solicitud</h2>
	</div>
	<div class="conten-form">	
		{!!Form::model($solicitud, ['route'=> ['solicitudes.update', $solicitud->id], 'method'=>'PUT', 'files'=>true])!!}
		<div class="row">
			@include('solicitudes.forms.sol')
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
				{!!Form::submit('Editar Solicitud',['class'=>'btn btn-accion'])!!}
			</div>
		</div>
		{!!Form::close()!!}
	</div>
@stop

@section('scripts')
	{!!Html::script('js/custom-file-input.js')!!}
@endsection