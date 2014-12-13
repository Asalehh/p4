@extends('main')


@section('title')
	View Tasks
@stop

@section('content')


	<ol class="breadcrumb">
	  <li><a href="/">Home</a></li>
	  <li><a href="/list/all">Lists</a></li>
	  <li class="active">{{$list->name}}</li>
	</ol>


	<span class="label label-info"><a style="color:#fff;" href="/list/edit/{{$list->id}}"><i class="fa fa-pencil-square-o"></i> Edit</a></span> <span class="label label-danger"><a style="color:#fff;" onclick="return confirm('Are you sure?');" href="/list/remove/{{$list->id}}"><i class="fa fa-trash"></i> Delete</a></span>

	@if (count($tasks) > 0)

		<h2>{{$list->name}}</h2>
		<h5>{{$list->desc}}</h5> 

		<table class="table table-hover table-responsive">
		@foreach ($tasks AS $task)

			<tr>
			<td style="min-width:80%;">

			@if ($task['taskdone'])
			<span class="taskCompleted">{{$task['taskname']}}</span> <br /> 
			@if($task['taskcontent'])<span class="timegray">{{$task['taskcontent']}}</span><br />@endif
			<span class="label label-default">Completed at: {{date('j/m/Y | h:i a',strtotime($task['taskdone_at'])) }}</span>
			@else

			<span class="taskTitle">{{$task['taskname']}}</span> <br /> 
			@if($task['taskcontent'])<span class="time">{{$task['taskcontent']}}</span> <br />@endif
			<span class="label-info">Created at: {{date('j/m/Y | h:i a',strtotime($task['created_at'])) }}</span>
			@endif
			
			</td>

			<td style="min-width:20%; text-align:right;">
				@if ($task['taskdone'] == 0)
					{{Form::open(['action'=>'TasksController@markcompleted','style'=>'display:inline;'])}}
						{{Form::hidden('taskid',$task['id'])}}
						<button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-check-square-o"></i> Mark as Completed</button>
					{{Form::close()}}
					
					<a class="btn btn-danger btn-sm" href="/task/delete/{{$task->id}}" title="Delete Task" onclick="return confirm('Are you sure?');"> <i class="fa fa-trash"></i></a>
				@else
					<a href="#" onclick="return false;" class="btn btn-success btn-sm"><i class="fa fa-check-square"></i> Completed</a>
				@endif
					

			</td>
			</tr>

		@endforeach
		</table>

	@else

		<h2>{{$list->name}}</h2>

		<h4>No Tasks in this list yet. <a href="/task/add">Create Task</a></h4>

	@endif


@stop