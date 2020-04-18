@extends('layouts.app')

@section('title', 'Test')

@section('content')
	<h1 style="margin-top: 50px;">List of Jobs</h1>
	@include('common.success')
	<div class="mb-3 mt-3">
		<div class="table-responsive-sm">
			<job-table-component jobsjson="{{$jobs}}"></job-table-component>
		</div>
	</div>
@endsection