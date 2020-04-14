@extends('layouts.app')

@section('title', 'Job Create')

@section('content')

	@include('common.error')
	{!! Form::open(['route' => 'job.store', 'method' => 'POST', 'files' => true]) !!}
		@include('job.form')
		{!! Form::submit('Create', ['class' => 'btn btn-primary'])!!}
	{!! Form::close() !!}
@endsection