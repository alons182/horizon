<?php

class Category extends Eloquent {
	
	protected $table = 'categories';
 
  
    public function scopeSearch($query, $search)
    {
        return $query->where(function($query) use ($search)
        {
              $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
        });
    }
    
    public function properties()
    {
        return $this->belongsToMany('Property');
    }
}
