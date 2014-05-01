<?php namespace App\Controllers\Admin;
 
use Category;
use App\Services\Validators\CategoryValidator;
use Input, Notification, Redirect, Sentry, Str;

class CategoriesController extends \BaseController {

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
    	$stateSearch = Input::get('status');
    
   
                               
    if($stateSearch !='')
    {
       
       
          $categories = Category::where('publish', '=', $stateSearch)
          							->where(function ($query) use ($querySearch) {
                                          $query->where('name', 'like', '%'.$querySearch.'%')
                                                ->orWhere('description', 'like', '%'.$querySearch.'%');
                                                
                                })->paginate(10);
       


      return \View::make('admin.categories.index')->with('categories',  $categories)
                                                 ->with('search',$querySearch)
                                                 ->with('selectedStatus',$stateSearch);
                                                 
    }elseif($querySearch)
    {
      $categories = Category::where(function ($query) use ($querySearch) {
                                          $query->where('name', 'like', '%'.$querySearch.'%')
                                                ->orWhere('description', 'like', '%'.$querySearch.'%');
                                                
                                })->paginate(10);
       


      return \View::make('admin.categories.index')->with('categories',  $categories)
                                                 ->with('search',$querySearch)
                                                 ->with('selectedStatus',$stateSearch);
                                               
    } else
    {
      return \View::make('admin.categories.index')->with('categories',  Category::paginate(10))
                                                ->with('search',$querySearch)
                                                ->with('selectedStatus',$stateSearch);
                                               
    }   
		


		
	
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return \View::make('admin.categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = new CategoryValidator;
 
        if ($validation->passes())
        {
                 

            $category = new Category;
            $category->name   = Input::get('name');
            $category->description    = Input::get('description');
            $category->publish   = Input::get('publish');;
            $category->save();

           

            Notification::success('The category was saved.');
 
            return Redirect::route('admin.categories.edit', $category->id);
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
     
    	return \View::make('admin.categories.edit')->with('category', Category::find($id));
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
             $category = Category::find($id);

            if($state==1){
               
                $category->publish    = 0;
                $category->save();
                Notification::success('The category was unpublished.');
            }
            else{

             $category->publish    = 1;
             $category->save();
             Notification::success('The category was published.');
             
            }
           return Redirect::route('admin.categories.index');
        }else
        {
            
             $validation = new CategoryValidator;
 
            if ($validation->passes())
            {
                $category = Category::find($id);
                $category->name   = Input::get('name');
                
                $category->description    = Input::get('description');
                
                $category->publish   = Input::get('publish');

                $category->save();

               
     
                Notification::success('The category was saved.');
     
                return Redirect::route('admin.categories.edit', $category->id);
            }
     
            return Redirect::back()->withInput()->withErrors($validation->errors);
           
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
		  $category = category::find($id);
	      //$category->categories()->detach();
	      $category->delete();

	     
	     
	      Notification::success('The category was deleted');

	      return Redirect::route('admin.categories.index');
	}

}
