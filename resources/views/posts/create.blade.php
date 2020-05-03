@extends('layouts.app')

@section('title', 'Posts')

@section('content')
	<div class="title-content-form">
		<h2>Crear Post</h2>
	</div>
	<div class="conten-form">	
		{!!Form::open(['route'=>'posts.store', 'method'=>'POST', 'files'=>true])!!}
		<div class="row">
			@include('posts.forms.pos')
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
				{!!Form::submit('Crear Post',['class'=>'btn btn-accion'])!!}
			</div>
		</div>
		{!!Form::close()!!}
	</div>
@stop

@section('scripts')
	{!!Html::script('js/custom-file-input.js')!!}
@endsection