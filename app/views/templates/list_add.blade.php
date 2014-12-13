@extends('main')

@section('title')
	Add List
@stop


@section('content')

	<ol class="breadcrumb">
	  <li><a href="/">Home</a></li>
	  <li><a href="/list/all">Lists</a></li>
	  <li class="active">Add List</li>
	</ol>

	<h3>Add New Task List</h3>

	{{Form::open(['action'=>'ListController@addList'])}}

	List Name* <Br />
	{{Form::text('name',null,['autofocus'=>'autofocus'])}} <br />

	List Description <br />
	{{Form::text('desc',null)}}<br />

	<Br /><br />
	{{Form::submit('Add List',['class'=>'btn btn-success'])}}
	{{Form::close()}}

@stop