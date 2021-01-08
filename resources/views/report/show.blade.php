@extends('layouts.app')

@section('title', 'Test')

@section('content')
	@include('common.success')
	<div class="d-flex align-items-center">
		<div>
			<h4 style="margin-top: 50px;">Job</h1>
			<h6>{{$report->job->name}}</h3>
			<h4>From</h1>
			<h6>{{\Carbon\Carbon::createFromTimestamp($report->from)->isoFormat('dddd MMMM Do YYYY, h:mm A')}}</h3>
			<h4>To</h1>
			<h6>{{\Carbon\Carbon::createFromTimestamp($report->to)->isoFormat('dddd MMMM Do YYYY, h:mm A')}}</h3>
		</div>
		<div class="ml-auto">
			<div class="dropdown show">
			  	<a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
			  	<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuLink">
				    <a data-toggle="modal" data-target="#deleteWarningModal" class="dropdown-item">Delete</a>
			  	</div>
			</div>
		</div>
	</div>	
	<div class="table-responsive-sm">
		<report-sheet-component reportsheetjson="{{ json_encode($employeereports) }}"></report-sheet-component>
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
	        	Are you sure you want to delete this report?
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
	        	{!! Form::open(['route'=>['report.destroy', $report->id], 'method' => 'DELETE']) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger'])!!}
				{!! Form::close() !!}
	      	</div>
	    </div>
	</div>
@endsection

@push('scripts')
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			let datatableConfig = {
			    responsive: true,
			    "dom": '<"html5buttons">lBTfgtip',
			    buttons: [
				    {
	                	extend: 'collection',
	                	text: 'Table',
				    	"buttons": [
				        	{ extend: 'copy' },
				        	{ extend: 'excelHtml5' },
				        	{ extend: 'pdf'  },
				        	{ extend: 'print' }
				    	]
				    }
			    ]
			};
			$(function(){
                $('#test-table').DataTable(datatableConfig);
            });
		});
	</script>
@endpush