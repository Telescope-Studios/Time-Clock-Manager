@extends('layouts.app')

@section('title', 'Job')

@section('content')
	<div class="container">
  		<h5>{{$job->name}}</h5>
  		<h4>{{$job->description}}</h4>
  		<h4>${{$job->rate}}</h4>
	</div>
	<div class="text-center">
		<h5> </h5>
		{!! Form::open(['route'=>['job.destroy', $job->id], 'method' => 'DELETE']) !!}
			{!! Form::submit('Eliminar', ['class' => 'btn btn-danger'])!!}
		{!! Form::close() !!}
	</div>
@endsection