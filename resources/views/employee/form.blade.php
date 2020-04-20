<div class="form-group"> 
		{!! Form::label('firstname', 'First Name') !!}
		{!! Form::text('firstname', null, ['class' => 'form-control	']) !!}
</div>
<div class="form-group"> 
		{!! Form::label('lastname', 'Last Name') !!}
		{!! Form::text('lastname', null, ['class' => 'form-control	']) !!}
</div>
<div class="form-group"> 
		{!! Form::label('slug', 'Slug') !!}
		{!! Form::text('slug', null, ['class' => 'form-control	']) !!}
</div>
<div class="form-group"> 
		{!! Form::label('avatar', 'Avatar') !!}
		<div class="custom-file">
  			{!! Form::file('avatar', ['class'=>'custom-file-input', 'accept'=>'image/*']) !!}<!--This is broken af v: label not changing v:-->
  			<label class="custom-file-label" for="avatar">Choose file</label>
		</div>
</div>
<div class="form-group"> 
		{!! Form::label('active', 'Active') !!}
		{{-- {!! Form::checkbox('active', null, $employee->active, ['class' => 'form-control ']) !!} --}}
		<div class="custom-control custom-switch">
  			{!! Form::checkbox('active', null, $employee->active ?? null, ['class' => 'form-control custom-control-input', 'style'=>'width: 30px; height: 30px;']) !!}
  			<label class="custom-control-label" for="active"></label>
		</div>
</div>

<div class="form-group"> 
		{!! Form::label('job', 'Job') !!}
		{!! Form::selectJob("job", $employee->job->id ?? null, $jobs, ["class"=>"form-control"]) !!}
</div>

@push('scripts')
	<script>
		document.addEventListener("DOMContentLoaded", function() {
		    document.querySelector('#avatar').addEventListener('change',function(e){
	  			var fileName = document.getElementById("avatar").files[0].name;
	  			var nextSibling = e.target.nextElementSibling;
	  			nextSibling.innerText = fileName;
	  			console.log(fileName);
			});
		});
	</script>
@endpush