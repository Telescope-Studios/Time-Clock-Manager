@extends('layouts.app')

@section('title', 'Test')

@section('content')
	<h1 style="margin-top: 50px;">{{$employee->firstname}} {{$employee->lastname}} - Timesheet</h1>
	@include('common.success')
	<div class="mb-3 mt-3">
		<div class="table-responsive-sm">
			<table class="table table-striped table-bordered" id="mydatatable3" style="width: 100%">
			  <thead>
			    <tr>
			      <th scope="col">Date</th>
			      <th scope="col">Job</th>
			      <th scope="col">Status</th>
			      <th scope="col">Total Hours</th>
			      <th scope="col">Total Earnings</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($employee->dates as $date)
					<tr>
				      <td>{{$date->name}}</td>
				      <td>{{$date->job->name}}</td>
				      <td>{{$date->complete ? 'Completed' : 'Pending'}}</td>
				      <td></td>
				      <td></td>
				    </tr>
			  	@endforeach
			  </tbody>
			  <tfoot>
			    <tr>
			      <th scope="col">Date</th>
			      <th scope="col">Job</th>
			      <th scope="col">Status</th>
			      <th scope="col">Total Hours</th>
			      <th scope="col">Total Earnings</th>
			    </tr>
			  </tfoot>
			</table>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/popper.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
	<style>
		.dataTables_wrapper .dataTables_paginate .paginate_button:hover{
    		color: white !important;
		    border: 0px;
		    background-color: #2980B9!important;
		    background: white !important;
		}
	</style>
	<script>
    	$('#mydatatable3').DataTable();
	</script>
@endsection