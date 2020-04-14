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
			{!! Form::file('avatar') !!}
	</div>
	<div class="form-group"> 
			{!! Form::label('active', 'Active') !!}
			{!! Form::checkbox('active', null, ['class' => 'form-control checkbox ', 'data-toggle'=>'toggle ']) !!}
	</div>