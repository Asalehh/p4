<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



Route::get('/home', ['before'=>'guest','uses'=>'HomeController@index']);


# User Routes
Route::get('/register',array('before'=>'guest', 'uses'=>'UserController@registrationForm'));
Route::post('/register',array('before'=>'csrf', 'uses'=>'UserController@register'));
Route::get('/login',array('before'=>'guest', 'uses'=>'UserController@loginForm'));
Route::post('/login', array('before'=>'csrf', 'uses'=>'UserController@login'));
Route::get('/logout',array('before'=>'auth','uses'=>'UserController@logout'));


# Tasks Routes
//Route::get('/',['before'=>'auth','uses'=>'TasksController@index']);
Route::get('/','TasksController@index');
Route::get('/mytasks',['before'=>'auth','uses'=>'TasksController@index']);
Route::group(['prefix'=>'task'], function(){

    Route::get('/all', array('before'=>'auth', 'uses'=>'TasksController@alltasks'));
    Route::get('/completed', array('before'=>'auth', 'uses'=>'TasksController@completedtasks'));
    Route::get('/incompleted', array('before'=>'auth', 'uses'=>'TasksController@incompletedtasks'));
    Route::get('/add', array('before'=>'auth', 'uses'=>'TasksController@addtaskform'));
    Route::post('/add',array('before'=>'csrf','uses'=>'TasksController@addtask'));
    Route::get('/edit/{id}', array('before'=>'auth','uses'=>'TasksController@taskeditForm'));
    Route::post('/edit/{id?}', array('before'=>'auth|csrf','uses'=>'TasksController@taskedit'));
    Route::post('/markcompleted', array('before'=>'auth|csrf','uses'=>'TasksController@markcompleted'));
    Route::get('/delete/{id}', array('before'=>'auth','uses'=>'TasksController@delete'));
    //Route::delete('task/remove/{id}', array('before'=>'auth','uses'=>'TasksController@taskremove'));

});



#Lists Routes
Route::group(['prefix'=>'list'],function(){

    Route::get('/add', array('before'=>'auth','uses'=>'ListController@addlistForm'));
    Route::post('/add', array('before'=>'auth','uses'=>'ListController@addList'));
    Route::get('/manage', array('before'=>'auth','uses'=>'ListController@manage'));
    Route::get('/all', array('before'=>'auth','uses'=>'ListController@showLists'));
    Route::get('/{id}', array('before'=>'auth','uses'=>'ListController@fetchListContent'));
    Route::get('/edit/{id}', array('before'=>'auth','uses'=>'ListController@editForm'));
    Route::post('/edit/{id?}', array('before'=>'auth','uses'=>'ListController@edit')); // id is optional because we'll pass the id in a hidden field.
    Route::get('/remove/{id?}', array('before'=>'auth','uses'=>'ListController@remove'));

});




	

