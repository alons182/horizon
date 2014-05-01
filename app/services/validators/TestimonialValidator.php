<?php namespace App\Services\Validators;
 
class TestimonialValidator extends Validator {
 
    public static $rules = array(
        'name'  => 'required',
        'email'  => 'required',
		'comments' => 'required'
		
		
		
       
    );
 
}
