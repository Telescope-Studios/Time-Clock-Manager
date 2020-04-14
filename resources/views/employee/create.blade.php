@extends('layouts.app')

@section('title', 'Employee Create')

@section('content')

	@include('common.error')
	{!! Form::open(['route' => 'employee.store', 'method' => 'POST', 'files' => true]) !!}
		@include('employee.form')
		{!! Form::submit('Submit', ['class' => 'btn btn-primary'])!!}
	{!! Form::close() !!}
@endsection