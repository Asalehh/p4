@extends('main')

@section('title')
	Add New Task
@stop


@section('content')

	<ol class="breadcrumb">
	  <li><a href="/">Home</a></li>
	  <li><a href="/task/all">All Tasks</a></li>
	  <li class="active">Add Task</li>
	</ol>

	<h3>Add New Task</h3>

	@if($lists->first())

		{{Form::open(['action'=>'TasksController@addtask'])}}
		Task Title* <br />
		{{Form::text('taskname',null,['class'=>'input','autofocus'=>'autofocus'])}} <br />

		Task Description <br />
		{{Form::textarea('desc',null,['class'=>'smalltextarea'])}}<br />

		List* <br />
		<select name="list">
			@foreach($lists as $list)
				<option value="{{$list->id}}">{{$list->name}}</option>
			@endforeach
		</select>

<br />

		<br /><br />
		{{Form::submit('Add Task',['class'=>'btn btn-success'])}}


	@else

		<h4>First you need to create at least one list. <a href="/list/add">Add new list</a></h4>

	@endif

@stop