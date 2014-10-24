<?php

use App\Services\Validators\ContactValidator;
class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function __construct()
    {
       $this->beforeFilter('langdetection:auto');

    }

	public function index()
	
	{
		
		$testimonials = Testimonial::where('publish', '=', 1)->take(3)->orderBy('created_at', 'DESC')->get();
		$properties = Property::where('publish', '=', 1)
									->where('featured','=',1)
									->where('type','<>','project')
									->take(6)->orderBy('created_at', 'DESC')->get();

		$projects = Property::where('publish', '=', 1)
									->where('featured','=',1)
									->where('type','=','project')
									->take(3)->orderBy('created_at', 'DESC')->get();
		
		return \View::make('index')->with('testimonials', $testimonials)
									->with('properties', $properties)
									->with('projects', $projects);
		//return View::make('index');
	}

	public function about()
	
	{
						
			return View::make('about');
	}

	public function tips()
	
	{
						
			return View::make('tips');
	}
	public function contact()
	
	{
						
			return View::make('contact');
	}

	public function store()
	{
		$validation = new ContactValidator;
 
        if ($validation->passes())
        {  

        	// Send activation code to the user so he can activate the account
                $data['name'] = Input::get('name');
                $data['email'] = Input::get('email');
                $data['comments'] = Input::get('comments');


                //Mail::pretend();
                Mail::send('emails.contact', $data, function($message)
                    {
                        $destinatario = "info@horizoncostarica.com";

                        $message->to($destinatario)->subject('Comentario enviado del formulario de contacto del sitio Rentameliberia.com');
                    });


            Notification::success('El comentario fue enviado.');
 
            return Redirect::to('contact');
         }
         // return Redirect::back()->withInput()->withErrors($validation->errors);
         return Redirect::back()->withErrors($validation->errors)->withInput();
	}
}