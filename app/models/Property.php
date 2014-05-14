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
     public function scopeSearchByCode($query, $code)
    {
        return $query->where(function($query) use ($code)
        {
             $query->where('code', '=', $code);
        });
    }
     public function scopeSearchByType($query, $type)
    {
        return $query->where(function($query) use ($type)
        {
             $query->where('type', '=', $type);
        });
    }
     public function scopeSearchByPrice($query, $priced, $priceh)
    {
        return $query->where(function($query) use ($priced, $priceh)
        {
             $query->whereBetween('priced', array($priced,$priceh));
        });
    }
     public function scopeSearchByFurniture($query, $furniture)
    {
        return $query->where(function($query) use ($furniture)
        {
            $query->where('furniture', '=', $furniture);
        });
    }
     public function scopeSearchByBedrooms($query, $bedrooms)
    {
        return $query->where(function($query) use ($bedrooms)
        {
            $query->where('bedrooms', '=', $bedrooms);
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
