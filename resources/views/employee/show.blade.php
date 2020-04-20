@extends('layouts.app')

@section('title', 'Employee')

@section('content')
	@include('common.success')
	<div class="d-flex">
		<div class="card-img-top d-flex align-items-center">
			<div>
				<img style="height: 200px; width: 200px; background-color: #EFEFEF; margin: 20px;" src="/images/{{$employee->avatar}}" class="rounded-circle img-responsive" alt="">
			</div>
			<div class="d-block">
				<h2 class="card-title">{{$employee->firstname}} {{$employee->lastname}}</h4>
				<h5 class="card-text">{{$employee->job->name}}</h5>
				<h6 class="card-text">{{$employee->active == true? 'Active' : 'Inactive'}}</h6>
			</div>
			<div class="ml-auto">
				<div class="dropdown show">
				  	<a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>

				  	<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					    <a href="{{ route('employee.edit', $employee->slug) }}" class="dropdown-item">Edit</a>
					    <a href="{{ route('employee.generateCard', $employee->slug) }}" class="dropdown-item">Generate Card</a>
					    <a class="dropdown-item" data-toggle="modal" data-target="#deleteWarningModal">Delete</a>
				  	</div>
				</div>
			</div>
		</div>
	</div>
	<h1 style="margin-top: 50px;">Timesheet</h1>
	<div class="table-responsive-sm">
		<timesheet-component employeejson="{{$employee}}"></timesheet-component>
	</div>
	<div class="modal fade" id="deleteWarningModal" tabindex="-1" role="dialog" aria-labelledby="deleteWarningModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
		    <div class="modal-header">
		        <h5 class="modal-title" id="deleteWarningModalLabel">Confirmation</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
	      	<div class="modal-body">
	        	Are you sure you want to delete this employee?
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
	        	{!! Form::open(['route'=>['employee.destroy', $employee->slug], 'method' => 'DELETE']) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger'])!!}
				{!! Form::close() !!}
	      	</div>
	    </div>
	</div>
@endsection