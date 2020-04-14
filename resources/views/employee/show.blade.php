@extends('layouts.app')

@section('title', 'Employee')

@section('content')
	<div class="text-center">
		@include('common.success')
		<h5 class="card-title">{{$employee->firstname}}</h5>
		<a href="/employee/{{$employee->slug}}/edit" class="btn btn-primary">Editar</a>
		{!! Form::open(['route'=>['employee.destroy', $employee->slug], 'method' => 'DELETE']) !!}
			{!! Form::submit('Delete', ['class' => 'btn btn-danger'])!!}
		{!! Form::close() !!}
	</div>
@endsection