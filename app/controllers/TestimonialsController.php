<?php

use App\Services\Validators\TestimonialValidator;

class TestimonialsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
    {
       $this->beforeFilter('langdetection:auto');

    }
    
	public function index()
	{
		
		$testimonials = Testimonial::where('publish', '=', 1)->paginate(3);
		return \View::make('testimonials.index')->with('testimonials', $testimonials);
		 										   
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = new TestimonialValidator;
 
        if ($validation->passes())
        {
		    $testimonials = new Testimonial;
            $testimonials->name   = Input::get('name');
            $testimonials->email   = Input::get('email');
            $testimonials->comments   = Input::get('comments');
            $testimonials->publish = 0; 
            $testimonials->save();

            Notification::success('La opinion fue enviada.');
 
            return Redirect::route('testimonials.index');

          }
 
        return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
	}

}
