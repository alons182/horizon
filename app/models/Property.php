<?php

class Property extends Eloquent {
	

	protected $table = 'properties';
 
   

    public function gallery()
    {
        return $this->hasMany('Gallery');
    }
    public function categories()
    {
        return $this->belongsToMany('Category');
    }
    public function users()
    {
        return $this->belongsToMany('User');
    }
     public function prequests()
    {
        return $this->hasMany('Prequest');
    }
}
