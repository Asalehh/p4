<?php

class UserController extends \BaseController {



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	public function loginForm(){

		return View::make('templates.login');

	}


	public function login(){

		
		if (isset($_POST['username'])){
			$credentials = Input::only('username','password');

			if (Auth::attempt($credentials, $remember = true)){
				return Redirect::to('/')->with('success_message','Logged In!');
			}else{
				return Redirect::back()->with('error_message','Wrong username or password')->withinput();
			}
		}else{
			return Redirect::back()->withinput();
			 
		}
		
		


	}


	public function logout(){

		Auth::logout();

		return Redirect::to('/')->with('flash_message','Logged Out!');

	}

	public function registrationForm(){

		return View::make('templates.register');
	}

	public function register(){

		$messages = array('Not an email','Not required field');

		$validatorRules = array(
								'username' => 'required|alpha_dash|min:5|unique:users,username',
								'password' => 'required|min:6|confirmed',
								'email'		=> 'required|email|unique:users,email'
								);

		$validator = Validator::make(Input::all(),$validatorRules);

		if ($validator->fails()){
			$messages = $validator->messages();
			Session::flash('feedbackMessageArray', $messages->all());
			return Redirect::back()->withinput();
		}else{
			$user = new User;
			$user->username = $_REQUEST['username'];
			$user->password = Hash::make($_REQUEST['password']);
			$user->email = $_REQUEST['email'];
			$user->save();

			# Login after registering a new user
			$credentials = Input::only(['username','password']);
			Auth::attempt($credentials, $remember = true);

			# Send welcome Email
			Mail::send('emails.welcome', ['username'=>$_REQUEST['username']], function($message){

			    $message->to($_REQUEST['email'], $_REQUEST['username'])->subject('Welcome to Task Manager!');
			});

			//Session::flash('successmessage','Account Created Successfully.');
			return Redirect::to('/')->with('success_message', 'Account Created Successfully.');
		}
	}

}
