@extends('main')

@section('title')
	Lists
@stop




@section('content')






@if(!empty($lists))
	
	<ol class="breadcrumb">
	  <li><a href="/">Home</a></li>
	  <li class="active">Lists</li>
	</ol>

	<h1>All Lists</h1>

	@foreach($lists as $list)
		<h2><a href="/list/{{$list->id}}">{{$list->name}} </a></h2>
		<h5>{{$list->desc}}</h5>
		
		<blockquote>
		@foreach($tasks as $task)
			@if($task->listid == $list->id)
				<li>{{$task->taskname}}</li>
			@endif
		@endforeach
		</blockquote>

	@endforeach

@else
There is no list to display. <a href="/list/add">Create New List</a>
@endif

@stop