@extends('layouts.app')

@section('title', 'Planeaciones')

@section('content')
	<div class="title-content-form">
		<h2>Editar Planeación</h2>
	</div>
	<div class="conten-form">	
		{!!Form::model($planeacion, ['route'=> ['planeaciones.update', $planeacion->id], 'method'=>'PUT', 'files'=>true])!!}
		<div class="row">
			@include('planeacion.forms.pla')
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
				{!!Form::submit('Editar Planeación',['class'=>'btn btn-accion'])!!}
			</div>
		</div>
		{!!Form::close()!!}
	</div>
@stop

@section('scripts')
	{!!Html::script('js/custom-file-input.js')!!}
@endsection