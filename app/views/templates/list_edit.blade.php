@extends('main')

@section('title')
	Edit List
@stop


@section('content')



	@foreach ($listdata as $list)

		<ol class="breadcrumb">
		  <li><a href="/">Home</a></li>
		  <li><a href="/list/all">Lists</a></li>
		  <li class="active">Edit List > {{$list->name}}</li>
		</ol>

		<h3>Edit Task List</h3>

		{{Form::open(['action'=>['ListController@edit','id'=>$list->id]] ) }}

		List Name* <Br />
		{{Form::text('name',"$list->name" )}} <br />

		List Description <br />
		{{Form::text('desc',"$list->desc")}}<br />
	@endforeach

		<Br /><br />
		{{Form::submit('Save Changes',['class'=>'btn btn-success'])}} 
		{{Form::close()}}

@stop