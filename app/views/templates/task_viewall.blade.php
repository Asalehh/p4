@extends('main')


@section('title')
	View Tasks
@stop

@section('content')

	@if (isset($message))
	<div class="alert alert-success">{{$message}}</div>
	@endif


	
		@if($show == 'all')
			<ol class="breadcrumb">
			  <li><a href="/">Home</a></li>
			  <li class="active">All tasks</li>
			</ol>
			<h2>All Tasks</h2>
		@elseif ($show == 'completed')
			<ol class="breadcrumb">
			  <li><a href="/">Home</a></li>
			  <li class="active">Complated Tasks</li>
			</ol>
			<h2>Completed Tasks</h2>
		@else
			<ol class="breadcrumb">
			  <li><a href="/">Home</a></li>
			  <li class="active">Incompleted Tasks</li>
			</ol>
			<h2>Incompleted tasks</h2>
		@endif

	@if ($tasks->first())

		<table class="table table-hover table-responsive">
		@foreach ($tasks AS $task)

			<tr>
			<td style="min-width:80%;">

			@if ($task['taskdone'])
			<span class="taskCompleted">{{$task['taskname']}}</span> <br /> 
			@if($task['taskcontent'])<span class="timegray">{{$task['taskcontent']}}</span><br />@endif
			<span class="label-default">Completed at: {{date('j/m/Y | h:i a',strtotime($task['taskdone_at'])) }}</span>
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
		<h3>No Tasks</h3>

	@endif


@stop