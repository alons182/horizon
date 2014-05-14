<?php namespace App\Controllers\Admin;
 

use Prequest;
use Property;

use Input, Notification, Redirect, Sentry, Str;

class PrequestsController extends \BaseController {

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

		if($search)
			$prequests = Prequest::Search($search)->with('property')->orderBy('created_at', 'desc')->paginate($this->limit);
		else
		 	$prequests = Prequest::with('property')->orderBy('created_at', 'desc')->paginate($this->limit);
	

		 return \View::make('admin.prequests.index')->with('prequests', $prequests)
			 										   ->with('search',$search);

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
	  $prequest = prequest::find($id);
     
      $prequest->delete();

     

     
     
      Notification::success('The Request was deleted.');

      return Redirect::route('admin.prequests.index');
	}

}
