@extends('layouts.app')

@section('title', 'Test')

@section('content')
	@include('common.success')
	<div class="d-flex align-items-center">
		<div>
			<h1 style="margin-top: 50px;">List of Reports</h1>
		</div>
		<div class="ml-auto">
			<div class="dropdown show">
			  	<a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
			  	<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				    <a href="{{ route('report.create') }}" class="dropdown-item">Generate Report</a>
			  	</div>
			</div>
		</div>
	</div>
	<div class="mb-3 mt-3">
		<div class="table-responsive-sm">
			<report-table-component reportsjson="{{$reports}}"></report-table-component>
		</div>
	</div>
@endsection

@push('scripts')
@endpush