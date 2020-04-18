@extends('layouts.app')

@section('title', 'Test')

@section('content')
	<h1 style="margin-top: 50px;">{{$employee->firstname}} {{$employee->lastname}} - Timesheet</h1>
	@include('common.success')
	<div class="mb-3 mt-3">
		<div class="table-responsive-sm">
			<timesheet-component employeejson="{{$employee}}"></timesheet-component>
		</div>
	</div>
@endsection