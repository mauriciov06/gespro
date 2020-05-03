@extends('layouts.app')

@section('title', 'Contactos')

@section('content')
	<div class="title-content-form">
		<h2>Editar contacto</h2>
	</div>
	<div class="conten-form">	
		{!!Form::model($contactocliente, ['route'=> ['contactos.update', $contactocliente->id], 'method'=>'PUT'])!!}
			<div class="row">
				@include('cliente.contacto-cliente.forms.concli')
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
					{!!Form::submit('Editar Contacto',['class'=>'btn btn-accion'])!!}
				</div>
			</div>
		{!!Form::close()!!}
	</div>
@stop

@section('scripts')
	{!!Html::script('js/custom-file-input.js')!!}
@endsection