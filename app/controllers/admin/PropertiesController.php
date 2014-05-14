<?php namespace App\Controllers\Admin;
 
use Property;
use Category;
use Gallery;
use Prequest;
use App\Services\Validators\PropertyValidator;
use Input, Notification, Redirect, Sentry, Str, Image;

class PropertiesController extends \BaseController {

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
      $categorySearch = Input::get('cat');
      $stateSearch = Input::get('status');
      
    
    if($categorySearch !="" || $stateSearch != ""  || !empty($search))
    {

        if($categorySearch !=""  && $stateSearch != "")
         {

           $category = Category::find($categorySearch);

           $properties = $category->properties()->Search($search)->where('publish', '=', $stateSearch)->with('categories')->paginate($this->limit);
         
         }
         elseif ($categorySearch !="")
         {
           
           $category = Category::find($categorySearch);
           
           $properties = $category->properties()->Search($search)->with('categories')->paginate($this->limit);

         }
         elseif ($stateSearch !="")
            $properties = Property::Search($search)->where('publish', '=', $stateSearch)->with('categories')->paginate($this->limit);
         else
            $properties = Property::Search($search)->with('categories')->paginate($this->limit);
    }
    else
      $properties = Property::with('categories')->paginate($this->limit);
   

    

     return \View::make('admin.properties.index')->with('properties',  $properties)
                                                  ->with('search',$search)
                                                  ->with('options', Category::where('publish', '=', 1)->lists('name', 'id'))
                                                   ->with('selected',$categorySearch)
                                                   ->with('selectedStatus',$stateSearch);
                                 
                 
  } 
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

    return \View::make('admin.properties.create')->with('options', Category::where('publish', '=', 1)->lists('name', 'id'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		

     $validation = new PropertyValidator;
 
        if ($validation->passes())
        {
            //imagen principal
            //$file = Input::file('image');

            if (Input::hasFile('image'))
            {

               do {
                 
                 $imagen_name = "main_".substr(sha1(rand(1,999999)),0,-30).".".Input::file('image')->getClientOriginalExtension();//.Input::file('image')->getClientOriginalName();

              } while (file_exists('images_properties/'.$imagen_name));
            
            


            }else
                $imagen_name ="";
            //galeria

            $files_galeria = Input::file('new_photo_file');
      
           

            $property = new Property;
            $property->code   = Input::get('code');
            $property->type   = Input::get('type');
            $property->title   = Input::get('title');
            $property->description    = Input::get('description');
            $property->furniture   = Input::get('furniture');
            $property->bedrooms   = Input::get('bedrooms');
            $property->priced    = (Input::get('priced')=="") ? 0 : Input::get('priced');
            $property->pricec = (Input::get('pricec')=="") ? 0 : Input::get('pricec');
            $property->image    =  $imagen_name;
            $property->location   = Input::get('location');
            $property->city   = Input::get('city');
            $property->area   = Input::get('area');
            $property->contact   = Input::get('contact');
            $property->featured   = Input::get('featured');
            $property->publish   = Input::get('publish');
            $property->save();

           //save categories

            $property->categories()->sync(Input::get('categories'));
            // resizing an uploaded file
             if (Input::hasFile('image')){
               
                Image::make(Input::file('image')->getRealPath())->resize(600, 450)->save('images_properties/'.$imagen_name);
               
                $thumb = Image::make('images_properties/'.$imagen_name)->resize(140, 140)->save('images_properties/thumb_'.$imagen_name);

             
            }
             if (Input::hasFile('new_photo_file')){
                 

             
                foreach ($files_galeria as $imagen) {

                   do {
                 
                       $imagen_name_galeria = substr(sha1(rand(1,999999)),0,-30).".".$imagen->getClientOriginalExtension();//.Input::file('image')->getClientOriginalName();

                    } while (file_exists('images_properties/'.$imagen_name_galeria));
            

                    Image::make($imagen->getRealPath())->resize(600, 450)->save('images_properties/'.$imagen_name_galeria);
               
                    $thumbG = Image::make('images_properties/'.$imagen_name_galeria)->resize(140, 140)->save('images_properties/thumb_'.$imagen_name_galeria);

                    $gallery = new Gallery;
                    $gallery->url = $imagen_name_galeria;
                    $gallery->url_thumb = 'thumb_'.$imagen_name_galeria;
                   
                    $property = Property::find($property->id);
                    $gallery = $property->gallery()->save($gallery);
                }
             
            }

            Notification::success('The property was saved.');
 
            return Redirect::route('admin.properties.index');
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
		 //return \View::make('admin.properties.show')->with('property', Property::find($id));
    echo "show".$id;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$property = Property::find($id);
    
    foreach ($property->categories as $category)
    {
        $selectedCategories[] = $category->id;
    }
   
    
    return \View::make('admin.properties.edit')->with('property', Property::find($id))
                                                ->with('options', Category::where('publish', '=', 1)->lists('name', 'id'))
                                                ->with('selected',$selectedCategories);

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
       
        if($option =='status'){

             $state = Input::get('state');
             $property = Property::find($id);

            if($state==1){
               
                $property->publish    = 0;
                $property->save();
                Notification::success('The Property was unpublished.');
            }
            else{

             $property->publish    = 1;
             $property->save();
             Notification::success('The Property was published.');
             
            }
           return Redirect::route('admin.properties.index');
        }elseif($option =='featured')
        {
            $featured = Input::get('featured');
             $property = Property::find($id);

            if($featured==1){
               
                $property->featured    = 0;
                $property->save();
                Notification::success('The Property is not featured.');
            }
            else{

             $property->featured    = 1;
             $property->save();
             Notification::success('The Property is featured.');
             
            }
           return Redirect::route('admin.properties.index');
        }else
        {
           // $file = Input::file('image');
           
           if (Input::hasFile('image'))
            {

               do {
                 
                 $imagen_name = "main_".substr(sha1(rand(1,999999)),0,-30).".".Input::file('image')->getClientOriginalExtension();//.Input::file('image')->getClientOriginalName();

              } while (file_exists('images_properties/'.$imagen_name));
            
            


            }else
                $imagen_name ="";
             
             $validation = new PropertyValidator;
 
            if ($validation->passes())
            {
                $property = Property::find($id);
                $property->code   = Input::get('code');
                $property->type   = Input::get('type');
                $property->title   = Input::get('title');
                $property->description    = Input::get('description');
                $property->furniture   = Input::get('furniture');
                $property->bedrooms   = Input::get('bedrooms');
                $property->priced    = (Input::get('priced')=="") ? 0 : Input::get('priced');
                $property->pricec = (Input::get('pricec')=="") ? 0 : Input::get('pricec');
               
               // para eliminar la imagen si se va actualizar con otra
                $name_image_delete = $property->image;
               if (Input::hasFile('image') )
               {
                  
                  if( $name_image_delete && file_exists('images_properties/'.$name_image_delete))
                  {
                    unlink("images_properties/".$name_image_delete);
                    unlink("images_properties/thumb_".$name_image_delete);
                   
                  }
                $property->image    =  $imagen_name;
               }
                  
                $property->location   = Input::get('location');
                $property->city   = Input::get('city');
                $property->area   = Input::get('area');
                $property->contact   = Input::get('contact');
                $property->featured   = Input::get('featured');
                $property->publish   = Input::get('publish');
                
                $property->save();

                $property->categories()->sync(Input::get('categories'));

                 if (Input::hasFile('image')){
                  Image::make(Input::file('image')->getRealPath())->resize(600, 450)->save('images_properties/'.$imagen_name);
                 
                  $thumb = Image::make('images_properties/'.$imagen_name)->resize(140, 140)->save('images_properties/thumb_'.$imagen_name);
                  }
     
                Notification::success('The Property was updated.');
     
                return Redirect::route('admin.properties.index');
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
		  $property = Property::find($id);
      $name_image_delete = $property->image;
      $property->categories()->detach();
      $property->delete();


      $affectedRowsRequest = Prequest::where('property_id', '=', $id)->delete();
     
      $images_galeria = Gallery::where('property_id', '=', $id)->get();
      $affectedRows = Gallery::where('property_id', '=', $id)->delete();
      
      //ELIMINA FOTO PRINCIPAL DEL SERVIDOR
      if($name_image_delete)
      {
        if(file_exists('images_properties/'.$name_image_delete))
        {
          unlink("images_properties/".$name_image_delete);
          unlink("images_properties/thumb_".$name_image_delete);
        }
      }

      //ELIMINA LAS FOTOS DE LA GALERIA DEL SERVIDOR
      foreach ($images_galeria as $imagen) {

         if(file_exists('images_properties/'.$imagen->url))
        {
          unlink("images_properties/".$imagen->url);
         
        }
          if(file_exists('images_properties/'.$imagen->url_thumb))
        {
         
          unlink("images_properties/".$imagen->url_thumb);
        }
         
      }
      
     
      Notification::success('The property was deleted.');

      return Redirect::route('admin.properties.index');
	}

	////////////////
    public function postSavegallery()
    {
       $id_property = Input::get('id');
       $file = $_FILES['file'];
       $nombre = $_FILES["file"]["name"];
       $extension = pathinfo($nombre, PATHINFO_EXTENSION);
         do {
                 
                 $nombre = substr(sha1(rand(1,999999)),0,-30).".".$extension;//.Input::file('image')->getClientOriginalName();

              } while (file_exists('images_properties/'.$nombre));

        
        if ($file)
        {
          Image::make($_FILES["file"]["tmp_name"])->resize(600, 450)->save('images_properties/'.$nombre);
          

          //move_uploaded_file($_FILES["file"]["tmp_name"], 'images_properties/' . $_FILES["file"]["name"]);
          
          $thumb = Image::make('images_properties/'.$nombre)->resize(140, 140)->save('images_properties/thumb_'.$nombre);

           $url = $nombre;
           $thumb = "thumb_".$nombre;

         
         

           
        
          $imagen = new Gallery;
          $imagen->url = $url;
          $imagen->url_thumb = $thumb;
         
          $Property = Property::find($id_property);
          
         $imagen = $Property->gallery()->save($imagen);
        

          $urls = array('url' => $url,
                        'url_thumb' => $thumb,
                        'id_imagen' => $imagen->id);

          echo json_encode($urls);
        }
      
       
      
       
       
    }
    public function postLoad()
    {
      $id_property = Input::get('id');

      $property = Property::find($id_property);
      $imagen = $property->gallery()->get();

       /* $urls = array('url' => $imagen[1]->url,
                      'thumb' => $imagen[1]->thumb);*/

       echo ($imagen);
      
      // echo var_dump($property);
       
    }
     public function postDeletegallery()
    {
      $id_property = Input::get('property_id');
      $id_imagen = Input::get('imagen_id');
     
      $images_galeria = Gallery::where('property_id', '=', $id_property)->get();

       $affectedRows = Gallery::where('property_id', '=', $id_property)
                              ->where('id', '=', $id_imagen)->delete();
      
      foreach ($images_galeria as $imagen) {

               if(file_exists('images_properties/'.$imagen->url) &&  $imagen->id == $id_imagen)
              {
                unlink("images_properties/".$imagen->url);
               
              }
                if(file_exists('images_properties/'.$imagen->url_thumb) &&  $imagen->id == $id_imagen)
              {
               
                unlink("images_properties/".$imagen->url_thumb);
              }
               
            }


     

       

       echo ($affectedRows);
     
      
       
    }
	

}
