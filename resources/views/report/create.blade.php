@extends('layouts.app')

@section('title', 'Report Generate')

@section('content')

	@include('common.error')
	{!! Form::open(['route' => 'report.store', 'method' => 'POST']) !!}
		@include('report.form')
		{!! Form::submit('Generate', ['class' => 'btn btn-primary'])!!}
	{!! Form::close() !!}
@endsection