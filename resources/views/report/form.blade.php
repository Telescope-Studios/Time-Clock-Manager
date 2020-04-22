<div class="form-group"> 
		{!! Form::label('job', 'Job') !!}
		{!! Form::selectJob("job", $report->job->id ?? null, $jobs, ["class"=>"form-control"]) !!}
</div>
<div class="form-group">
	{!! Form::label('from', 'From') !!}
    <div class="input-group date" id="datetime1" data-target-input="nearest">
        <input name="from" value="{{ \Carbon\Carbon::createFromTimestamp($report->from ?? Carbon\Carbon::now()->timestamp)->isoFormat('M/D/YY h:mm A') ?? null }}" type="text" class="form-control datetimepicker-input" data-target="#datetime1" readonly/>
        <div class="input-group-append" data-target="#datetime1" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
    </div>
</div>
<div class="form-group">
	{!! Form::label('to', 'To') !!}
    <div class="input-group date" id="datetime2" data-target-input="nearest">
        <input name="to" value="{{ \Carbon\Carbon::createFromTimestamp($report->to ?? Carbon\Carbon::now()->timestamp)->isoFormat('M/D/YY h:mm A') ?? null }}" type="text" class="form-control datetimepicker-input" data-target="#datetime2" readonly/>
        <div class="input-group-append" data-target="#datetime2" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
    </div>
</div>


@push('scripts')
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			$(function () {
            	$('#datetime1').datetimepicker({ignoreReadonly: true});
        	});
        	$(function () {
            	$('#datetime2').datetimepicker({ignoreReadonly: true});
        	});
		});
	</script>
@endpush