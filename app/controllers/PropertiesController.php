<?php
use App\Services\Validators\PrequestValidator;
class PropertiesController extends BaseController {

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
	    $categorySearch = (Input::get('cat')=="") ? 1 : Input::get('cat');
	    $pricedSearch = Input::get('priced');
	    $pricehSearch = Input::get('priceh');
	    $typeSearch = Input::get('type');
	    $codeSearch = trim(Input::get('code'));
	    $furnitureSearch = Input::get('furniture');
	    $bedroomsSearch = Input::get('bedrooms');
	    
	     $properties;
	    

	    $category = Category::find($categorySearch);
	    
	         

	    if($codeSearch != "")
	    {
	    	 $properties = $category->properties()->where('publish', '=', 1)
	    	 										->where('code', '=', $codeSearch)->orderBy('priced', 'asc')->paginate(8);

	     
	    }
	    elseif($typeSearch != "" && $pricedSearch != "" && $pricehSearch != "" && $furnitureSearch != "" && $bedroomsSearch != "")
	    {
	    	 $properties = $category->properties()->where('publish', '=', 1)
	    	 										->where('type', '=', $typeSearch)
	    	 										->whereBetween('priced', array($pricedSearch,$pricehSearch))
	    	 										->where('furniture', '=', $furnitureSearch)
	    	 										->where('bedrooms', '=', $bedroomsSearch)
	          										->where(function ($query) use ($querySearch) {
	                                          			$query->where('code', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('title', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('type', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('description', 'like', '%'.$querySearch.'%');
	                                })->orderBy('priced', 'asc')->paginate(8);

	    
	    }
	     elseif($typeSearch != "" && $pricedSearch != "" && $pricehSearch != "" && $furnitureSearch != "")
	    {
	    	 $properties = $category->properties()->where('publish', '=', 1)
	    	 										->where('type', '=', $typeSearch)
	    	 										->whereBetween('priced', array($pricedSearch,$pricehSearch))
	    	 										->where('furniture', '=', $furnitureSearch)
	    	 										->where(function ($query) use ($querySearch) {
	                                          			$query->where('code', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('title', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('type', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('description', 'like', '%'.$querySearch.'%');
	                                })->orderBy('priced', 'asc')->paginate(8);

	     
	    }
	     elseif($typeSearch != "" && $pricedSearch != "" && $pricehSearch != "" &&  $bedroomsSearch != "")
	    {
	    	 $properties = $category->properties()->where('publish', '=', 1)
	    	 										->where('type', '=', $typeSearch)
	    	 										->whereBetween('priced', array($pricedSearch,$pricehSearch))
	    	 										->where('bedrooms', '=', $bedroomsSearch)
	    	 										->where(function ($query) use ($querySearch) {
	                                          			$query->where('code', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('title', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('type', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('description', 'like', '%'.$querySearch.'%');
	                                })->orderBy('priced', 'asc')->paginate(8);

	     
	    }
	     elseif($typeSearch != "" && $pricedSearch != "" && $pricehSearch != "")
	    {
	    	 $properties = $category->properties()->where('publish', '=', 1)
	    	 										->where('type', '=', $typeSearch)
	    	 										->whereBetween('priced', array($pricedSearch,$pricehSearch))
	    	 										->where(function ($query) use ($querySearch) {
	                                          			$query->where('code', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('title', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('type', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('description', 'like', '%'.$querySearch.'%');
	                                })->orderBy('priced', 'asc')->paginate(8);

	    
	    }
	     elseif($pricedSearch != "" && $pricehSearch != "" && $furnitureSearch != "" && $bedroomsSearch != "")
	    {
	    	 $properties = $category->properties()->where('publish', '=', 1)
	    	 										->whereBetween('priced', array($pricedSearch,$pricehSearch))
	    	 										->where('furniture', '=', $furnitureSearch)
	    	 										->where('bedrooms', '=', $bedroomsSearch)
	          										->where(function ($query) use ($querySearch) {
	                                          			$query->where('code', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('title', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('type', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('description', 'like', '%'.$querySearch.'%');
	                                })->orderBy('priced', 'asc')->paginate(8);

	     
	    }
	     elseif($pricedSearch != "" && $pricehSearch != "" && $furnitureSearch != "")
	    {
	    	 $properties = $category->properties()->where('publish', '=', 1)
	    	 										->whereBetween('priced', array($pricedSearch,$pricehSearch))
	    	 										->where('furniture', '=', $furnitureSearch)
	    	 										->where(function ($query) use ($querySearch) {
	                                          			$query->where('code', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('title', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('type', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('description', 'like', '%'.$querySearch.'%');
	                                })->orderBy('priced', 'asc')->paginate(8);

	    
	    }
	     elseif($pricedSearch != "" && $pricehSearch != ""  && $bedroomsSearch != "")
	    {
	    	 $properties = $category->properties()->where('publish', '=', 1)
	    	 										->whereBetween('priced', array($pricedSearch,$pricehSearch))
	    	 										->where('bedrooms', '=', $bedroomsSearch)
	          										->where(function ($query) use ($querySearch) {
	                                          			$query->where('code', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('title', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('type', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('description', 'like', '%'.$querySearch.'%');
	                                })->orderBy('priced', 'asc')->paginate(8);

	   
	    }
	    elseif($furnitureSearch != "" && $bedroomsSearch != "")
	    {
	    	 $properties = $category->properties()->where('publish', '=', 1)
	    	 										->where('furniture', '=', $furnitureSearch)
	    	 										->where('bedrooms', '=', $bedroomsSearch)
	          										->where(function ($query) use ($querySearch) {
	                                          			$query->where('code', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('title', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('type', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('description', 'like', '%'.$querySearch.'%');
	                                })->orderBy('priced', 'asc')->paginate(8);

	   
	    }
	    elseif($typeSearch != "")
	    {
	    	 $properties = $category->properties()->where('publish', '=', 1)
	    	 										->where('type', '=', $typeSearch)
	          										->where(function ($query) use ($querySearch) {
	                                          			$query->where('code', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('title', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('type', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('description', 'like', '%'.$querySearch.'%');
	                                })->orderBy('priced', 'asc')->paginate(8);

	   
	    }


	    elseif($pricedSearch != "" && $pricehSearch != "")
	    {
	    	 $properties = $category->properties()->where('publish', '=', 1)
	    	 										->whereBetween('priced', array($pricedSearch,$pricehSearch))
	          										->where(function ($query) use ($querySearch) {
	                                          			$query->where('code', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('title', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('type', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('description', 'like', '%'.$querySearch.'%');
	                                })->orderBy('priced', 'asc')->paginate(8);

	   
	    }
	    elseif($furnitureSearch != "")
	    {
	    	 $properties = $category->properties()->where('publish', '=', 1)
	    	 										->where('furniture', '=', $furnitureSearch)
	          										->where(function ($query) use ($querySearch) {
	                                          			$query->where('code', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('title', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('type', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('description', 'like', '%'.$querySearch.'%');
	                                })->orderBy('priced', 'asc')->paginate(8);

	    
	    }
	    elseif($bedroomsSearch != "")
	    {
	    	 $properties = $category->properties()->where('publish', '=', 1)
	    	 										->where('bedrooms', '=', $bedroomsSearch)
	          										->where(function ($query) use ($querySearch) {
	                                          			$query->where('code', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('title', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('type', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('description', 'like', '%'.$querySearch.'%');
	                                })->orderBy('priced', 'asc')->paginate(8);

	     
	    }
	    
	    
	    elseif($querySearch != "")
	    {
	       
	         

	          $properties = $category->properties()->where('publish', '=', 1)
	          										
	          										->where(function ($query) use ($querySearch) {
	                                          			$query->where('code', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('title', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('type', 'like', '%'.$querySearch.'%')
	                                                	->orWhere('description', 'like', '%'.$querySearch.'%');
	                                })->orderBy('priced', 'asc')->paginate(8);
	        


	      
	    
	    }
	    else
	    {
	     
	      	
	      	$properties = $category->properties()->where('publish', '=', 1)->orderBy('priced', 'asc')->paginate(8);
	      	   
	      	
	     
	     
	    }  
	    // para busqueda relacionada
	    Session::forget('properties.id');
	    foreach ($properties as $property)
				{
				   
				    	Session::push('properties.id',$property->id ); 
				   


				}
	    // Session::put('p',$properties->get()->toArray() ); 
	    // echo json_encode($properties);   
	    return \View::make('properties.index')->with('properties',  $properties)
	                                                 ->with('search',$querySearch)
	                                                  ->with('code',$codeSearch)
	                                                   ->with('priced',$pricedSearch)
	                                                    ->with('priceh',$pricehSearch)
	                                                     ->with('bedrooms',$bedroomsSearch)
	                                                      ->with('type',$typeSearch)
	                                                       ->with('furniture',$furnitureSearch)
	                                               // ->with('options', Category::where('publish', '=', 1)->lists('name', 'id'))
	                                                ->with('selected',$categorySearch);

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
		$property = Property::find($id);

	  	//VERIFICAR SI ESTA EN FAVORITOS DEL USUARIO
	  	$existe ="";
		
		$user = Sentry::getUser();
		  if ($user)
            {
            	

            	//$property = Property::find($property_id);

            	foreach ($user->properties as $property)
				{
				    if( $property->pivot->property_id == $id)
				    	$existe = $property->pivot->property_id;
				   


				}

				
	        }

	      // PROPIEDADES DE LA BUSQUEDA REALIZADA

		    $pids = Session::get('properties.id'); 
		    
		    //Eliminar el id actual del resto de la busqueda
		    for ($i=0; $i <  count($pids) ; $i++) { 
		    	 if( $pids[$i] == $id)
				     unset($pids[$i]);
		    }
		   
		   	if(count($pids)>0)
		   		$properties_search = Property::whereIn('id', $pids)->get();//paginate(2);
		   	else
		   		$properties_search = Property::paginate(6);//$properties_search = Property::whereIn('id', array('') )->get();//paginate(2);


	    return \View::make('properties.show')->with('property', Property::find($id))
	    									 ->with('properties_search', $properties_search)
	    									->with('favorite', $existe);
	                                               
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
		//
	}
	public function savefavorites()
	{
		$property_id = Input::get('id');
		$existe ="";
		 $user = Sentry::getUser();
		  if ($user)
            {
            	$property = Property::find($property_id);
            	
				if(count($property->users()->where('user_id', '=', $user->id)->get()))
            		 echo "<span class='mok'>Ya tienes en tus favoritos esta propiedad</span>";
            	else
            		{
            			$user->properties()->attach($property_id);

			            echo "<span class='ok'>Propiedad Guardada</span>";
            		}
			
            	
            }else
            	echo "<span class='msg merror'>Necesitas iniciar sesion para guardar tus propiedades favoritas</span>";
	}
	public function deletefavorites()
	{
		$property_id = Input::get('id');
		 $user = Sentry::getUser();
		  if ($user)
            {
			 $user->properties()->detach($property_id);
			 echo "<span class='ok'>Propiedad Eliminada </span>";
			}
	}
	public function favorites()
	{
		$user = Sentry::getUser();
		 if ($user)
            {
            	
            	
            	
            	return \View::make('properties.index')->with('properties',  $user->properties()->paginate(8))
	                                                 ->with('search','')
	                                                ->with('code','')
	                                                   ->with('priced','')
	                                                    ->with('priceh','')
	                                                     ->with('bedrooms','')
	                                                      ->with('type','')
	                                                       ->with('furniture','')
	                                                ->with('selected','');

	             

            	
            }
	}
	public function requestproperty()
	{
		
		$property_id = Input::get('property_id');

		$validation = new PrequestValidator;
 
        if ($validation->passes())
        {



		   $request = new Prequest;
            $request->name   = Input::get('name');
            $request->email   = Input::get('email');
            $request->phone   = Input::get('phone');
            $request->comments   = Input::get('comments');
          
           $property = Property::find($property_id);
           $request = $property->prequests()->save($request);

            echo 'ok';
           
         }else
         	echo 'error';
           
		
	}
	

}
