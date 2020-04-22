@extends('layouts.app')

@section('title', 'Report Edit')

@section('content')

	@include('common.error')
	{!! Form::model($report, ['route' => ['report.update', $report], 'method' => 'PUT']) !!}
		@include('report.form')
		{!! Form::submit('Update', ['class' => 'btn btn-primary'])!!}
	{!! Form::close() !!}

@endsection