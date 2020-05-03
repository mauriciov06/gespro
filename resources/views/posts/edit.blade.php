@extends('layouts.app')

@section('title', 'Posts')

@section('content')
	<div class="title-content-form">
		<h2>Editar Post</h2>
	</div>
	<div class="conten-form">	
		{!!Form::model($post, ['route'=> ['posts.update', $post->id], 'method'=>'PUT', 'files'=>true])!!}
		<div class="row">
			@include('posts.forms.pos')
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
				{!!Form::submit('Editar Post',['class'=>'btn btn-accion'])!!}
			</div>
		</div>
		{!!Form::close()!!}
	</div>
@stop

@section('scripts')
	{!!Html::script('js/custom-file-input.js')!!}
@endsection