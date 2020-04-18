@extends('layouts.app')

@section('title', 'Test')

@section('content')
	<h1 style="margin-top: 50px;">List of Employees</h1>
	@include('common.success')
	<div class="mb-3 mt-3">
		<div class="table-responsive-sm">
			<employee-table-component employeesjson="{{$employees}}"></employee-table-component>
		</div>
	</div>
@endsection

@push('scripts')
@endpush