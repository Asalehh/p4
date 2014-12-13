<?php

class ListController extends \BaseController {



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}



	public function addlistForm(){

		return View::make('templates.list_add');
	}

	public function addList(){

		$validator = Validator::make(Input::all(), ['name'=>'required|min:3']);

		if ($validator->passes()){
			$name = Input::get('name');
			$desc = Input::get('desc');

			$list = new TaskList;
			$list->name = $name;
			$list->desc = $desc;
			$list->userid = Auth::id();
			$list->save();
		}else{

			return Redirect::back()->withErrors($validator)->withInput();
		}

		return Redirect::back()->with('success_message','List Added.');
	}


	public function showLists(){

		$lists = TaskList::where('userid','=',Auth::id())->get();
		$tasks = Task::where('userid','=',Auth::id())->get();

		return View::make('templates.list_all')->with('lists',$lists)->with('tasks',$tasks);
	}


	public function fetchListContent($id){

		// Fetch tasks from list


		

		$tasks = Task::where('listid','=',$id)->where('userid','=', Auth::id())->get();
		$list = TaskList::find($id);


		return View::make('templates.list_content')->with('tasks', $tasks)->with('list',$list);

		//return Redirect::to('/list/all')->with('error_message','List not found.');
	}

	public function remove($id){

		try{
			// Checking the requested item is exist and belongs to the logged in user.
			$list = TaskList::where('id','=',$id)->where('userid','=',Auth::id())->firstOrFail();
		}catch (exception  $e) {
			//If not found or list is not belong to user.
			//As anyone can change the ID in get request, any user may type any list id.
			return Redirect::to('/list/all')->with('error_message','List Not found or no permission to delete.');
		}

		$tasks = Task::where('listid','=',$id)->delete();
		$listDelete= TaskList::where('id','=',$id)->where('userid','=',Auth::id())->delete();
		return Redirect::to('/list/all')->with('success_message','List Deleted.');
	}


	public function editForm($id){

		try {

			// Checking the requested item is exist and belongs to the logged in user.
			TaskList::where('id','=',$id)->where('userid','=',Auth::id())->firstOrFail();

		}catch (exception $e){

			return Redirect::to('/list/all')->with('error_message','List not found or no permission.');

		}

		$list = TaskList::where('id','=',$id)->where('userid','=',Auth::id())->get();

		return View::make('templates.list_edit')->with('listdata',$list);
	}


	public function edit($id){

		try {

			// Checking the requested item is exist and belongs to the logged in user.
			TaskList::where('id','=',$id)->where('userid','=',Auth::id())->firstOrFail();

		}catch(exception $e){
			return Redirect::to('/list/all')->with('error_message','List not found or no permission.');
		}
		
		$name = Input::get('name');
		$desc = Input::get('desc');

		$validator = Validator::make(Input::all(), ['name'=>'required']);
		if ($validator->passes()){
			$list = TaskList::find($id);
			$list->name = $name;
			$list->desc = $desc;
			$list->save();

			return Redirect::to('/list/'.$id)->with('success_message','List Updated.');
		}else{
			return Redirect::back()->withErrors($validator);
		}
	}
}
