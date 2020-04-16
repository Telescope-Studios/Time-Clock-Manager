@extends('layouts.app')

@section('title', 'Employee')

@section('content')
	@include('common.success')
	<div class="card text-center mx-auto" style="width: 18rem;">
  		<img style="height: 200px; width: 200px; background-color: #EFEFEF; margin: 20px;" src="/images/{{$employee->avatar}}" class="card-img-top rounded-circle mx-auto d-block" alt="">
		<div class="card-body">
			<h4 class="card-title">{{$employee->firstname}} {{$employee->lastname}}</h4>
			<h5 class="card-text">{{App\Job::find($employee->job)->name ?? null}}</h5>
			{!! QrCode::size(150)->generate($employee->slug); !!}
			<h6 class="card-text">{{$employee->slug}}</h6>
		</div>
	</div>
	<div class="text-center">
		<h5> </h5>
		<a href="/employee/{{$employee->slug}}/generateCard" class="btn btn-primary">Download</a>
		<h5> </h5>
		<a href="/employee/{{$employee->slug}}/showTimesheet" class="btn btn-primary">View Timesheet</a>
		<h5> </h5>
		{!! Form::open(['route'=>['employee.destroy', $employee->slug], 'method' => 'DELETE']) !!}
			{!! Form::submit('Eliminar', ['class' => 'btn btn-danger'])!!}
		{!! Form::close() !!}
	</div>

@endsection