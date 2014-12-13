<?php

class TasksController extends \BaseController {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		if(Auth::user()){

			$tasks = Task::where('userid','=',Auth::id())->orderby('id','desc')->get();
			$lists = TaskList::where('userid','=',Auth::id())->get();

			return View::make('templates.task_viewall')->withTasks($tasks)->withLists($lists)->withShow('all');
		}else{

			return View::make('templates.homeGuest');
		}

	}


	public function addtaskform(){

		$lists = TaskList::where('userid','=',Auth::id())->get();
		return View::make('templates.task_add')->with('message',null)->with('lists',$lists);
	}

	public function addtask(){


		$validator = Validator::make(Input::all(),['taskname'=>'required|min:4', 'list'=>'required']);
		if ($validator->passes()){
			$taskName = Input::get('taskname');
			$taskDesc = Input::get('desc');

			$task = new Task;
			$task->taskname = $taskName;
			$task->taskcontent = $taskDesc;
			$task->listid = Input::get('list');
			$task->userid = Auth::id();
			$task->save();


			return Redirect::back()->with('success_message','Task Added successfully');
		}else{

			return Redirect::back()->withErrors($validator);

		}
	}




	// show all tasks
	public function alltasks()
	{
		//
		$tasks = Task::where('userid','=',Auth::id())->orderby('id','desc')->get();
		return View::make('templates.task_viewall')->with('tasks',$tasks)->with('show','all');
	}

	// show completed tasks only
	public function completedtasks(){

		$tasks = Task::where('userid','=',Auth::id())->where('taskdone','=','1')->orderby('id','desc')->get();
		return View::make('templates.task_viewall')->with('tasks',$tasks)->with('show','completed');

	}

	// show Incompleted tasks only
	public function incompletedtasks(){

		$tasks = Task::where('userid','=',Auth::id())->where('taskdone','<>','1')->orderby('id','desc')->get();
		return View::make('templates.task_viewall')->with('tasks',$tasks)->with('show','incompleted');

	}

	// Mask task as completed
	public function markcompleted(){

		$taskid = $_POST['taskid'];

		try{
			// checking the called item is exist and belongs to logged in user.
			$task = Task::where('id','=',$taskid)->where('userid','=',Auth::id())->firstOrFail();
		}catch (exception $e){
			return Redirect::to('/')->with('error_message',"Task not found or no permission.");
		}

		if ($taskid){

			//$task = Task::find($taskid);
			$task->taskdone = 1;
			$task->taskdone_at = date('y-m-d G:i:s');
			$task->save();

			return Redirect::back()->with('success_message','Marked as completed');

		}else{

			return Redirect::back();
		}
	}

	public function fetchTasksFromList($listID){
		$tasksFromList = Task::where('listid','=',$listID)->get();
		return $tasksFromList; 

	}


	public function delete($id){

		try{
			// Check if item exist and belongs to logged in user.
			$task = Task::where('id','=',$id)->where('userid','=',Auth::id())->firstOrFail();
		}catch (exception $e){

			return Redirect::to('/')->with('error_message',"Task not found or no permission to delete.");
		}

		$task->delete();
		return Redirect::to('/')->with('success_message',"Task has been deleted.");

	}


}
