<?php 

class Task extends Eloquent {

    public function User() {
        # Book task belongs to user
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('User');
    }

    public function TaskList(){
    	return $this->belongsTo('TaskList');
    }
    
}