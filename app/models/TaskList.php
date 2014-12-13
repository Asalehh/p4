<?php

class TaskList extends Eloquent {

	protected $table = 'lists';

	public function Task(){

		return $this->hasMany('Task');
	}

	public function User(){

		return $this->belongsTo('User');
	}


}
