<?php namespace App\Controllers\Admin;
 
    use Auth, BaseController, Form, Input, Redirect, Sentry, View;
 
    class AuthController extends \BaseController {
 
        
        public function __construct()
            {
               $this->beforeFilter('langdetection:auto');

            }
        public function getLogin()
        {
            return View::make('admin.auth.login');
        }
 
        public function postLogin()
        {
            $credentials = array(
                'email'    => Input::get('email'),
                //'username'    => Input::get('username'),
                'password' => Input::get('password')
            );
 
            try
            {
                
                // Find the user using the user id
                $user = Sentry::getUserProvider()->findById(1);

                // Find the Administrator group
               

                // Check if the user is in the administrator group
                





                $user = Sentry::authenticate($credentials, false);
                $admin = Sentry::getGroupProvider()->findByName('Admin');
 
                if ($user)
                {
                    
                    if ($user->inGroup($admin))
                    {
                        return Redirect::route('admin.properties.index');
                    }
                    else
                    {
                       return Redirect::route( 'homes.index' );

                    }

                    //return Redirect::route('admin.properties.index');
                }
            }
            catch(\Exception $e)
            {
                return Redirect::route('admin.login')->withErrors(array('login' => $e->getMessage()));
            }
        }
 
        public function getLogout()
        {
            $user = Sentry::getUser();
            $admin = Sentry::getGroupProvider()->findByName('Admin');

            
            if ($user)
            {
                if ($user->inGroup($admin))
                {
                    Sentry::logout();

                   return Redirect::route('admin.login');
                }else{
                    Sentry::logout();
                    return Redirect::route( 'homes.index' );
                }
            }  

           
 
            
        }

        
 
 
    }
