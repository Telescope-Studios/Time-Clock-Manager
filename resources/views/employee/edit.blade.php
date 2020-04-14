@extends('layouts.app')

@section('title', 'Employee Edit')

@section('content')

	@include('common.error')
	{!! Form::model($employee, ['route' => ['employee.update', $employee], 'method' => 'PUT', 'files' => true]) !!}
		@include('employee.form')
		{!! Form::submit('Update', ['class' => 'btn btn-primary'])!!}
	{!! Form::close() !!}

@endsection