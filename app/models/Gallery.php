<?php

class Gallery extends Eloquent {
	

	protected $table = 'gallery';
 
  
    public function property()
    {
        return $this->belongsTo('Property');
    }
}
