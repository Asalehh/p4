@extends('main')



@section('title')
	Log In
@stop

@section('content')



	<h1>Log In</h1>


	{{Form::open(array('action' => 'UserController@login'))}}


		{{Form::label('username','User Name')}}<br />
		{{Form::text('username', null, array('class'=>'input','autofocus'=>'autofocus'))}} <br />

		{{Form::label('password', 'Password')}}<br />
		{{Form::password('password', array('class'=>'input'))}}<br />

		<br />
		{{Form::submit('Log In', array('class'=>'btn btn-primary'))}}

	{{Form::close()}}
@stop