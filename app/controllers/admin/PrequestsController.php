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

    }
	public function index()
	{
		$querySearch = trim(Input::get('q'));

		if($querySearch)
		{
			$prequests = Prequest::where(function ($query) use ($querySearch) {
	                          			$query->where('name', 'like', '%'.$querySearch.'%')
	                                	->orWhere('email', 'like', '%'.$querySearch.'%')
	                                	->orWhere('comments', 'like', '%'.$querySearch.'%');
	                                	
		                                })->orderBy('created_at', 'desc')->paginate(10);
			 return \View::make('admin.prequests.index')->with('prequests', $prequests)
			 										   ->with('search',$querySearch);
		 }else
		 {
		 	
			 return \View::make('admin.prequests.index')->with('prequests', Prequest::orderBy('created_at', 'desc')->paginate(10))
			 										   ->with('search',$querySearch);
		 }

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
