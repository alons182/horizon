<?php

class Testimonial extends Eloquent {
	

	protected $table = 'testimonials';
 
  	public function scopeSearch($query, $search)
    {
        return $query->where(function($query) use ($search)
        {
              $query->where('name', 'like', '%'.$search.'%')
                	->orWhere('email', 'like', '%'.$search.'%')
                	->orWhere('comments', 'like', '%'.$search.'%');
        });
    }
   
}
