<?php

class Category extends Eloquent {
	
	protected $table = 'categories';
 
  
    public function properties()
    {
        return $this->belongsToMany('Property');
    }
}
