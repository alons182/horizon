<?php namespace App\Controllers\Admin;
 

use Input, Notification, Redirect, Sentry, Str;

class UsersController extends \BaseController {

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
		$querySearch = trim(Input::get('q'));
      
   
   

       $users =  \Cartalyst\Sentry\Users\Eloquent\User::with('groups')->paginate($this->limit);//Sentry::getUserProvider()->getEmptyUser()->paginate(10);



     return \View::make('admin.users.index')->with('users', $users)
                                           ->with('search',$querySearch);

           
     
             
   
   
                 
  } 
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
     $groups = Sentry::getGroupProvider()->findAll();

 
    return \View::make('admin.users.create')->with('options',$groups);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		

     try
            {
                // Let's register a user.
                $user = Sentry::createUser(array(
                    'email'    => Input::get('email'),
                    //'username' => Input::get('username'),
                    'password' => Input::get('password'),
                    'first_name' => Input::get('first_name'),
                    'last_name' => Input::get('last_name'),
                    'activated' => true,


                ),true);

                // Find the group using the group id
                $group = Sentry::getGroupProvider()->findById(Input::get('groups'));

                 // Assign the group to the user
                 $user->addGroup($group);

                // Let's get the activation code
               // $activationCode = $user->getActivationCode();

                // Send activation code to the user so he can activate the account
                Notification::success('the user was created.');
 
                 return Redirect::route('admin.users.index');
            }
             catch(\Exception $e)
            {
                return Redirect::route('admin.users.create')->withErrors(array('register' => $e->getMessage()));
            }    
          
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
		$user = Sentry::getUserProvider()->findById($id);
    $groups = Sentry::getGroupProvider()->findAll();
    
   
   
    
    return \View::make('admin.users.edit')->with('user', $user)
                                                ->with('options', $groups);

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try
    {
        // Find the user using the user id
        $user = Sentry::getUserProvider()->findById($id);
         
        // Update the user details
        $user->email = Input::get('email');
        $user->first_name =  Input::get('first_name');
        $user->last_name =  Input::get('last_name');
        if(Input::get('password'))
           $user->password =  Input::get('password');
      
        $group = Sentry::getGroupProvider()->findById(Input::get('groups'));

         if ($user->inGroup( $group))
          {
              // User is in Administrator group
          }
          else
          {
              foreach ($user->getGroups() as $user_group)
                  $user->removeGroup($user_group);

              
                               
                $user->addGroup($group);              
                
          }

         
        // Update the user
        if ($user->save())
        {
           Notification::success('the user was updated.');
           return Redirect::route('admin.users.edit',$user->id);
        }
        else
        {
           Notification::success('the user was no updated.');

           return Redirect::route('admin.users.edit',$user->id);
        }
    }
    catch (Cartalyst\Sentry\Users\UserExistsException $e)
    {
        Notification::success('User with this login already exists.');
       return Redirect::route('admin.users.edit',$user->id);
    }
    catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
    {
        Notification::success('User was not found.');
         return Redirect::route('admin.users.index');

        
    }
     catch(\Exception $e)
            {
                return Redirect::route('admin.users.edit',$user->id)->withErrors(array('register' => $e->getMessage()));
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
		  try{


          $user = Sentry::getUserProvider()->findById($id);
          $user->properties()->detach();
          $user->delete();
         
         
         
          Notification::success('The user was deleted.');

          return Redirect::route('admin.users.index');

       }catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
      {
           Notification::success('The user  was not found.');
            return Redirect::route('admin.users.index');
      }
	}

	
	

}
