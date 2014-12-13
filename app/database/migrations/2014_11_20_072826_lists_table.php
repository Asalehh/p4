<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ListsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('lists',function($table){

			$table->increments('id');
			$table->string('name');
			$table->string('desc');
			$table->integer('userid')->unsigned();
			$table->timestamps();

			$table->foreign('userid')->references('id')->on('users');
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
		Schema::drop('lists');
	}

}
