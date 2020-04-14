@extends('layouts.app')

@section('title', 'Job Edit')

@section('content')

	@include('common.error')
	{!! Form::model($job, ['route' => ['job.update', $job], 'method' => 'PUT', 'files' => true]) !!}
		@include('job.form')
		{!! Form::submit('Update', ['class' => 'btn btn-primary'])!!}
	{!! Form::close() !!}

@endsection