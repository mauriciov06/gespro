@extends('layouts.app')

@section('title', 'Usuario')

@section('content')
	<h2>{{$usuario->name}}</h2>
	<img src="/avatares/{{$usuario->avatar}}">
@stop