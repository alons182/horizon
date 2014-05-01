<?php namespace App\Services\Validators;
 
class PrequestValidator extends Validator {
 
    public static $rules = array(
        'name'  => 'required',
        'email'  => 'required',
		'comments' => 'required',
		'property_id' => 'required'
		
		
		
       
    );
 
}
