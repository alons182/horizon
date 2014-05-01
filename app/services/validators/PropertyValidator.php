<?php namespace App\Services\Validators;
 
class PropertyValidator extends Validator {
 
    public static $rules = array(
        'categories'  => 'required',
        'code'  => 'required',
		'title' => 'required',
		'description'=> 'required',
		'priced'=> 'required',
		'location'=> 'required',
		'city'=> 'required',
		'bedrooms'=> 'required|Numeric',
		'priced'=> 'required|Numeric',
		'pricec'=> 'required|Numeric',
		
       
    );
 
}
