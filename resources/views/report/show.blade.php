@extends('layouts.app')

@section('title', 'Test')

@section('content')
	@include('common.success')
	<h4 style="margin-top: 50px;">Job</h1>
	<h6>{{$report->job->name}}</h3>
	<h4>From</h1>
	<h6>{{\Carbon\Carbon::createFromTimestamp($report->from)->isoFormat('dddd MMMM Do YYYY, h:mm A')}}</h3>
	<h4>To</h1>
	<h6>{{\Carbon\Carbon::createFromTimestamp($report->to)->isoFormat('dddd MMMM Do YYYY, h:mm A')}}</h3>
	<div class="table-responsive-sm">
		<table class="table table-striped table-bordered" id="test-table" style="width: 100%">
        <thead>
            <tr>
                <th scope="col">Employee</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Total Hours</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employeereports as $employeereport)
            	@if($employeereport->hours >= 0.01)
	            	<tr>
		            	<td>{{ $employeereport->employee->firstname }} {{ $employeereport->employee->lastname }}</td>
		            	<td>{{ $employeereport->from != null ? \Carbon\Carbon::createFromTimestamp($employeereport->from)->isoFormat('dddd MMMM Do YYYY, h:mm A') : 'None'}}</td>
		            	<td>{{ $employeereport->to != null ? \Carbon\Carbon::createFromTimestamp($employeereport->to)->isoFormat('dddd MMMM Do YYYY, h:mm A') : 'None'}}</td>
		            	<td>{{number_format((float)$employeereport->hours, 2, '.', '')}}</td>
		            </tr>
	            @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">Employee</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Total Hours</th>
            </tr>
        </tfoot>
    </table>
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
	      	{{-- <div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
	        	{!! Form::open(['route'=>['employee.destroy', $employee->slug], 'method' => 'DELETE']) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger'])!!}
				{!! Form::close() !!}
	      	</div> --}}
	    </div>
	</div>
@endsection

@push('scripts')
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			$(function(){
                    $('#test-table').DataTable();
            });
		});
	</script>
@endpush