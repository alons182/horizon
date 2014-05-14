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
 	   $this->limit = 8;
    }

	
	public function index()
	
	{
		

		$search = trim(Input::get('q'));
	    $categorySearch = (Input::get('cat')=="") ? 1 : Input::get('cat');
	    $pricedSearch = Input::get('priced');
	    $pricehSearch = Input::get('priceh');
	    $typeSearch = Input::get('type');
	    $codeSearch = trim(Input::get('code'));
	    $furnitureSearch = Input::get('furniture');
	    $bedroomsSearch = Input::get('bedrooms');
	    
	     $properties;
	    

	    $category = Category::find($categorySearch);
	    
	    $user = Sentry::getUser();

	    $propertiesWithUsers = $category->properties()->with(array('users' => function($query) use($user)
														{
														    $query->where('users.id', $user->id);

														}));

	    if($codeSearch != "")
	    {
	    	 $properties = $propertiesWithUsers->SearchByCode($codeSearch)->where('publish', '=', 1)->get();//->paginate(8);

			
	    }
	    elseif($typeSearch != "" && $pricedSearch != "" && $pricehSearch != "" && $furnitureSearch != "" && $bedroomsSearch != "")
	    {
	    	 $properties = $propertiesWithUsers->SearchByType($typeSearch)
	    	 									  ->SearchByPrice($pricedSearch,$pricehSearch)
	    	 									  ->SearchByFurniture($furnitureSearch)
	    	 									  ->SearchByBedrooms($bedroomsSearch)
	    	 									  ->Search($search)
	    	 									  ->where('publish', '=', 1)
	    	 									  ->orderBy('priced', 'asc')->paginate($this->limit);

	    	
	    }
	     elseif($typeSearch != "" && $pricedSearch != "" && $pricehSearch != "" && $furnitureSearch != "")
	    {
	    	  $properties = $propertiesWithUsers->SearchByType($typeSearch)
	    	 									  ->SearchByPrice($pricedSearch,$pricehSearch)
	    	 									  ->SearchByFurniture($furnitureSearch)
	    	 									  ->Search($search)
	    	 									  ->where('publish', '=', 1)
	    	 									  ->orderBy('priced', 'asc')->paginate($this->limit);
	    	
	     
	    }
	     elseif($typeSearch != "" && $pricedSearch != "" && $pricehSearch != "" &&  $bedroomsSearch != "")
	    {
	    	 
	    	 $properties = $propertiesWithUsers->SearchByType($typeSearch)
	    	 									  ->SearchByPrice($pricedSearch,$pricehSearch)
	    	 									  ->SearchByBedrooms($bedroomsSearch)
	    	 									  ->Search($search)
	    	 									  ->where('publish', '=', 1)
	    	 									  ->orderBy('priced', 'asc')->paginate($this->limit);

	    	

	     
	    }
	     elseif($typeSearch != "" && $pricedSearch != "" && $pricehSearch != "")
	    {
	    	 

	    	 $properties = $propertiesWithUsers->SearchByType($typeSearch)
	    	 									  ->SearchByPrice($pricedSearch,$pricehSearch)
	    	 									  ->Search($search)
	    	 									  ->where('publish', '=', 1)
	    	 									  ->orderBy('priced', 'asc')->paginate($this->limit);

	    	

	    
	    }
	     elseif($pricedSearch != "" && $pricehSearch != "" && $furnitureSearch != "" && $bedroomsSearch != "")
	    {
	    	
	    	 $properties = $propertiesWithUsers->SearchByPrice($pricedSearch,$pricehSearch)
	    	  									  ->SearchByFurniture($furnitureSearch)
	    	  									  ->SearchByBedrooms($bedroomsSearch)
	    	 									  ->Search($search)
	    	 									  ->where('publish', '=', 1)
	    	 									  ->orderBy('priced', 'asc')->paginate($this->limit);


	    	
	     
	    }
	     elseif($pricedSearch != "" && $pricehSearch != "" && $furnitureSearch != "")
	    {
	    	 
	    	$properties = $propertiesWithUsers->SearchByPrice($pricedSearch,$pricehSearch)
	    	  									  ->SearchByFurniture($furnitureSearch)
	    	  									  ->Search($search)
	    	 									  ->where('publish', '=', 1)
	    	 									  ->orderBy('priced', 'asc')->paginate($this->limit);

	    	

	    
	    }
	     elseif($pricedSearch != "" && $pricehSearch != ""  && $bedroomsSearch != "")
	    {
	    	
	    	$properties = $propertiesWithUsers->SearchByPrice($pricedSearch,$pricehSearch)
	    	  									  ->SearchByBedrooms($bedroomsSearch)
	    	 									  ->Search($search)
	    	 									  ->where('publish', '=', 1)
	    	 									  ->orderBy('priced', 'asc')->paginate($this->limit);


	   
	    }
	     elseif($typeSearch != "" && $furnitureSearch && $bedroomsSearch != "")
	    {
	    	
	    	$properties = $propertiesWithUsers->SearchByType($typeSearch)
	    										  ->SearchByFurniture($furnitureSearch)
	    	  									  ->SearchByBedrooms($bedroomsSearch)
	    	 									  ->Search($search)
	    	 									  ->where('publish', '=', 1)
	    	 									  ->orderBy('priced', 'asc')->paginate($this->limit);
	    	
	   
	    }
	    elseif($furnitureSearch != "" && $bedroomsSearch != "")
	    {
	    	
	    	$properties = $propertiesWithUsers->SearchByFurniture($furnitureSearch)
	    	  									  ->SearchByBedrooms($bedroomsSearch)
	    	 									  ->Search($search)
	    	 									  ->where('publish', '=', 1)
	    	 									  ->orderBy('priced', 'asc')->paginate($this->limit);
	    	
	   
	    }
	     elseif($typeSearch != "" && $bedroomsSearch != "")
	    {
	    	
	    	$properties = $propertiesWithUsers->SearchByType($typeSearch)
	    	  									  ->SearchByBedrooms($bedroomsSearch)
	    	 									  ->Search($search)
	    	 									  ->where('publish', '=', 1)
	    	 									  ->orderBy('priced', 'asc')->paginate($this->limit);
	    	
	   
	    }
	      elseif($typeSearch != "" && $furnitureSearch != "")
	    {
	    	
	    	$properties = $propertiesWithUsers->SearchByType($typeSearch)
	    	  									  ->SearchByFurniture($furnitureSearch)
	    	 									  ->Search($search)
	    	 									  ->where('publish', '=', 1)
	    	 									  ->orderBy('priced', 'asc')->paginate($this->limit);
	    	
	   
	    }

	    elseif($typeSearch != "")
	    {
	    	
	    	$properties = $propertiesWithUsers->SearchByType($typeSearch)
	    	  									  ->Search($search)
	    	 									  ->where('publish', '=', 1)
	    	 									  ->orderBy('priced', 'asc')->paginate($this->limit);

	   
	    }


	    elseif($pricedSearch != "" && $pricehSearch != "")
	    {
	    	 
	    	 $properties = $propertiesWithUsers->SearchByPrice($pricedSearch,$pricehSearch)
	    	  									  ->Search($search)
	    	 									  ->where('publish', '=', 1)
	    	 									  ->orderBy('priced', 'asc')->paginate($this->limit);

	   
	    }
	    elseif($furnitureSearch != "")
	    {
	    	
	    	$properties = $propertiesWithUsers->SearchByFurniture($furnitureSearch)
	    	  									  ->Search($search)
	    	 									  ->where('publish', '=', 1)
	    	 									  ->orderBy('priced', 'asc')->paginate($this->limit);
	    
	    }
	    elseif($bedroomsSearch != "")
	    {
	    	
	    	$properties = $propertiesWithUsers->SearchByBedrooms($bedroomsSearch)
    	 									  ->Search($search)
    	 									  ->where('publish', '=', 1)
    	 									  ->orderBy('priced', 'asc')->paginate($this->limit);

	     
	    }
	    
	    
	    elseif($search != "")
	    {
	       
	         $properties = $propertiesWithUsers->Search($search)
    	 									  ->where('publish', '=', 1)
    	 									  ->orderBy('priced', 'asc')->paginate($this->limit);

	    
	    }
	    else
	    {
	     	

	      	$properties = $propertiesWithUsers->where('publish', '=', 1)->orderBy('priced', 'asc')->paginate($this->limit);//get();//paginate($this->limit);
			
	     
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
	                                                 ->with('search',$search)
	                                                  ->with('code',$codeSearch)
	                                                   ->with('priced',$pricedSearch)
	                                                    ->with('priceh',$pricehSearch)
	                                                     ->with('bedrooms',$bedroomsSearch)
	                                                      ->with('type',$typeSearch)
	                                                       ->with('furniture',$furnitureSearch)
	                                               // ->with('options', Category::where('publish', '=', 1)->lists('name', 'id'))
	                                                ->with('selected',$categorySearch)
	                                                ->with('logueado',Sentry::check());

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
	    									->with('favorite', $existe)
	    									->with('logueado',Sentry::check());
	                                               
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
            	
            	
            	
            	return \View::make('properties.index')->with('properties',  $user->properties()->with('users')->paginate($this->limit))
	                                                 ->with('search','')
	                                                  ->with('code','')
	                                                   ->with('priced','')
	                                                    ->with('priceh','')
	                                                     ->with('bedrooms','')
	                                                      ->with('type','')
	                                                       ->with('furniture','')
	                                                ->with('selected','')
	                                                ->with('logueado',Sentry::check());

	             

            	
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
