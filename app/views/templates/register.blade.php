@extends('main')


@section('content')

	

	@if (Session::get('feedbackMessageArray'))

		<div class="alert alert-danger">
			<ul>
				@foreach(Session::get('feedbackMessageArray') AS $message)
					
					@if ($message == 'validation.alphanum')
						<li>Username is Alphanumeric</li>
					@else
						<li>{{$message}}</li>
					@endif
					
				@endforeach
			</ul>
		</div> 

	@endif



	<h1>Register</h1>

	{{Form::open( array('action'=>'UserController@register'))}}

		{{Form::label('username',"User Name")}} <br />
		{{Form::text('username',null, array('class'=>'input', 'autofocus'=>'autofocus') ) }} <br />


		{{Form::label('email',"Email")}} <br />
		{{Form::text('email',null, array('class'=>'input') ) }} <br />


		{{Form::label('password', 'Password')}} <br />
		{{Form::password('password',array('class'=>'input') )}} <br />


		{{Form::label('password_confirmation', 'Confirm Password')}} <br />
		{{Form::password('password_confirmation',array('class'=>'input') )}} <br />

		<br /><br />
		{{Form::submit('Register Me', array('class'=>'btn btn-primary'))}}


	{{Form::close()}}

@stop