<?php namespace App\Controllers\Admin;
 

use Testimonial;

use Input, Notification, Redirect, Sentry, Str;

class TestimonialsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
    {
       $this->beforeFilter('langdetection:auto');
	   $this->limit = 10;
    }
	
	public function index()
	{
		$search = trim(Input::get('q'));
		$stateSearch = Input::get('status');

		if($stateSearch !='')
    		$testimonials = Testimonial::Search($search)->where('publish', '=', $stateSearch)->paginate($this->limit);
		elseif($search)
    		$testimonials = Testimonial::Search($search)->paginate($this->limit);
		else
			$testimonials = Testimonial::paginate($this->limit);
			 
		return \View::make('admin.testimonials.index')->with('testimonials', $testimonials)
		 										   ->with('search',$search)
		 										    ->with('selectedStatus',$stateSearch);

		
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
		//
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
		$option = Input::get('option');
       
        if($option =='publish'){

             $state = Input::get('state');
             $testimonial = Testimonial::find($id);

            if($state==1){
               
                $testimonial->publish    = 0;
                $testimonial->save();
                Notification::success('The testimonial was unpublished.');
            }
            else{

             $testimonial->publish    = 1;
             $testimonial->save();
             Notification::success('The testimonial was published.');
             
            }
           return Redirect::route('admin.testimonials.index');
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$testimonial = Testimonial::find($id);
     
      	$testimonial->delete();

     

     
     
      Notification::success('The Testimonial was deleted.');

      return Redirect::route('admin.testimonials.index');
	}

}
