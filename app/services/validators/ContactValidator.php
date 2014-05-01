<?php namespace App\Services\Validators;
 
class ContactValidator extends Validator {
 
    public static $rules = array(
        'name'  => 'required',
        'email'  => 'required|email',
		'comments' => 'required'
		
		
		
       
    );
 
}
