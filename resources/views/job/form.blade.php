<div class="form-group"> 
		{!! Form::label('name', 'Name') !!}
		{!! Form::text('name', null, ['class' => 'form-control	']) !!}
</div>
<div class="form-group"> 
		{!! Form::label('description', 'Description') !!}
		{!! Form::text('description', null, ['class' => 'form-control	']) !!}
</div>
<div class="form-group"> 
		{!! Form::label('rate', 'Rate') !!}
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">$</span>
			</div>
			{!! Form::number('rate', null, ['class' => 'form-control ', 'min'=>'0', 'step' => ".01"]) !!}
		</div>
		
</div>