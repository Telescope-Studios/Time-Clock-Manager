@extends('layouts.app')

@section('title', 'Test')

@section('content')
	<h1 style="margin-top: 50px;">List of Employees - {{\Carbon\Carbon::now()->format('H:i')}}</h1>
	@include('common.success')
	<div class="mb-3 mt-3">
		<div class="table-responsive-sm">
			<table class="table table-striped table-bordered" id="mydatatable" style="width: 100%">
			  <thead>
			    <tr>
			      <th></th>
			      <th scope="col">Active</th>
			      <th scope="col">First Name</th>
			      <th scope="col">Last Name</th>
			      <th scope="col">Slug</th>
			      <th scope="col">Job</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($employees as $employee)
					<tr>
					  <th scope="row">
				      	<a href="/employee/{{$employee->slug}}" title="View" data-toggle="tooltip"><!---View-->
				      		<i class="far fa-eye"></i>
						</a>
						<a href="/employee/{{$employee->slug}}/edit" title="Edit" data-toggle="tooltip"><!---Edit-->
							<i class="fas fa-edit"></i>
						</a>
					  </th>
					  @if($employee->active == true)
			  		    <td>Yes</td>	
			  		  @else
			  		 	<td>No</td>
			  		  @endif
				      <td>{{$employee->firstname}}</td>
				      <td>{{$employee->lastname}}</td>
				      <td>{{$employee->slug}}</td>
				      <td>{{App\Job::find($employee->job)->name ?? null}}</td><!--need to fix this properly-->
				    </tr>
			  	@endforeach
			  </tbody>
			  <tfoot>
			    <tr>
			      <th></th>
			      <th scope="col">Active</th>
			      <th scope="col">First Name</th>
			      <th scope="col">Last Name</th>
			      <th scope="col">Slug</th>
			      <th scope="col">Job</th>
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
    	$('#mydatatable').DataTable();
	</script>
@endsection