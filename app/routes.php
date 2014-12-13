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


Route::get('/db', function(){

    $test = DB::select('SHOW DATABASES;');
    if ($test){
        print_r($test);
    }

});


Route::get('/mail',function(){

        Mail::send('emails.welcome', array('key' => 'value'), function($message)
        {
            $message->to('webmaster@nilehoster.com', 'John Smith')->subject('Welcome!');
        });

            return 'SENT';
});


Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});



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


/*

Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});
*/




	

