<?php

class Property extends Eloquent {
	

	protected $table = 'properties';
 
    public function scopeSearch($query, $search)
    {
        return $query->where(function($query) use ($search)
        {
             $query->where('code', 'like', '%'.$search.'%')
                    ->orWhere('title', 'like', '%'.$search.'%')
                    ->orWhere('type', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
        });
    }

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
