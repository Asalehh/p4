<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		
		Schema::create('tasks',function($table){
			$table->increments('id');
			$table->timestamps();
			$table->string('taskname');
			$table->string('taskcontent');
			$table->integer('taskdone');
			$table->datetime('taskdone_at');
			//$table->datetime('taskdue_at');
			$table->integer('userid')->unsigned();
			$table->integer('listid')->unsigned();
			$table->foreign('userid')->references('id')->on('users'); 
			$table->foreign('listid')->references('id')->on('lists'); 

		});
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::dropIfExists('tasks');
	}

}
