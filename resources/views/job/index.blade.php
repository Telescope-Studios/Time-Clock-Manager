@extends('layouts.app')

@section('title', 'Test')

@section('content')
	<div class="d-flex align-items-center">
		<div>
			<h1 style="margin-top: 50px;">List of Jobs</h1>
		</div>
		<div class="ml-auto">
			<div class="dropdown show">
			  	<a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
			  	<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuLink">
				    <a href="{{ route('job.create') }}" class="dropdown-item">Create</a>
			  	</div>
			</div>
		</div>
	</div>
	@include('common.success')
	<div class="mb-3 mt-3">
		<div class="table-responsive-sm">
			<job-table-component jobsjson="{{$jobs}}"></job-table-component>
		</div>
	</div>
@endsection