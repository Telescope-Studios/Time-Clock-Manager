@extends('layouts.app')

@section('title', 'Test')

@section('content')
	<h1 style="margin-top: 50px;">List of Jobs</h1>
	@include('common.success')
	<div class="mb-3 mt-3">
		<div class="table-responsive-sm">
			<table class="table table-striped table-bordered" id="mydatatable2" style="width: 100%">
			  	<thead>
			    	<tr>
			    		<th></th>
			      		<th scope="col">Name</th>
			      		<th scope="col">Description</th>
			      		<th scope="col">Rate</th>
			    	</tr>
			  	</thead>
			  	<tbody>
			  		@foreach($jobs as $job)
						<tr>
						  	<th scope="row">
					      		<a href="/job/{{$job->id}}" title="View" data-toggle="tooltip"><!---View-->
					      			<i class="far fa-eye"></i>
								</a>
								<a href="/job/{{$job->id}}/edit" title="Edit" data-toggle="tooltip"><!---Edit-->
									<i class="fas fa-edit"></i>
								</a>
						  	</th>
						    <td>{{$job->name}}</td>
						    <td>{{$job->description}}</td>
					      	<td>${{number_format($job->rate, 2, '.', '')}}</td>
				    	</tr>
			  		@endforeach
			  	</tbody>
			  	<tfoot>
			    	<tr>
			      		<th></th>
			      		<th scope="col">Name</th>
			      		<th scope="col">Description</th>
			      		<th scope="col">Rate</th>
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
    	$('#mydatatable2').DataTable();
	</script>
@endsection