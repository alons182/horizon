<?php 
 
   // use Auth, BaseController, Form, Input, Redirect, Sentry, View;
 
    class AuthController extends BaseController {
 
       
        public function __construct()
        {
           $this->beforeFilter('langdetection:auto');

        }
        
        public function getLogin()
        {
            return View::make('auth.login');
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
               
 
                if ($user)
                {
                    
                   if ($user->isActivated())
                            {
                               return Redirect::route('homes.index');
                            }
                            else
                            {
                               return Redirect::route('register');
                            }   

                    
                }
            }
            catch(\Exception $e)
            {
                return Redirect::route('login')->withErrors(array('login' => $e->getMessage()));
            }
        }
 
        public function getLogout()
        {
            $user = Sentry::getUser();
                       
            if ($user)
            {
               
                    Sentry::logout();

                   return Redirect::route('homes.index');
               
            }  

           
 
            
        }


        public function getRegister()
        {
            return \View::make('auth.register');
           
        }

         public function postRegister()
        {
           
          //register
           try
            {
                // Let's register a user.
                $user = Sentry::register(array(
                    'email'    => Input::get('email'),
                    //'username' => Input::get('username'),
                    'password' => Input::get('password'),
                    'first_name' => Input::get('first_name'),
                    'last_name' => Input::get('last_name'),
                ),false);

                 $group = Sentry::getGroupProvider()->findByName('Basic');

                 // Assign the group to the user
                 $user->addGroup($group);

                // Let's get the activation code
                $activationCode = $user->getActivationCode();

                // Send activation code to the user so he can activate the account
                $data['code'] = $activationCode;
                $data['email'] = Input::get('email');

                //Mail::pretend();
                Mail::send('emails.activation_code', $data, function($message)
                    {
                        $message->to(Input::get('email'))->subject('User activation code from horizoncostarica.com');
                    });

                

                Notification::success(Lang::get('labels.message-register-ok'));
 
                 return Redirect::route('register');
            }
             catch(\Exception $e)
            {
                return Redirect::route('register')->withErrors(array('register' => $e->getMessage()));
            }    

       
           
        }
        public function getActivation()
        {
            return \View::make('auth.activate');
           
        }
         public function postActivation()
        {
           
          try
                {
                   
                    

                    $user = Sentry::findUserByLogin(Input::get('email_actv'));



                    // Attempt to activate the user
                    if ($user->attemptActivation(Input::get('code')))
                    {
                        
                         Notification::success(Lang::get('labels.message-activate-ok'));

                        return Redirect::route('login');
                    }
                    else
                    {
                         Notification::error(Lang::get('labels.message-activate-error'));
                         return Redirect::route('activation');
                    }
                }
                catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
                {
                    Notification::error(Lang::get('labels.message-user-notfound'));
                    return Redirect::route('activation');
                    
                }
                catch (Cartalyst\Sentry\Users\UserAlreadyActivatedException $e)
                {
                    Notification::error(Lang::get('labels.message-user-activate'));
                    return Redirect::route('activation');
                    
                }

       
           
        }


         public function getReset()
        {
            return \View::make('auth.reset');
           
        }
         public function postReset()
        {
           
          try
                {
                   
                    

                    $user = Sentry::findUserByLogin(Input::get('email_reset'));



                   // Get the password reset code
                    $resetCode = $user->getResetPasswordCode();
                    $data['email'] = Input::get('email_reset');
                    $data['code'] = $resetCode;

                    Mail::send('emails.reset_pass', $data, function($message)
                    {
                        $message->to(Input::get('email_reset'))->subject('Code reset password');
                    });

                    Notification::success(Lang::get('labels.message-reset-ok'));
 
                  return Redirect::route('login');

                }
                catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
                {
                    Notification::error(Lang::get('labels.message-user-notfound'));
                    return Redirect::route('reset');
                    
                }
               

       
           
        }

         public function getNewpassword()
        {
            return \View::make('auth.newpass');
           
        }
         public function postNewpassword()
        {
           
          try
                {
                   
                    

                    $user = Sentry::findUserByLogin(Input::get('email_newp'));
                    $code = Input::get('code');

                    // Check if the reset password code is valid
                    if ($user->checkResetPasswordCode($code))
                    {
                        // Attempt to reset the user password
                        if ($user->attemptResetPassword($code, Input::get('password')))
                        {
                            // Password reset passed
                            

                            Notification::success(Lang::get('labels.message-newpassword-ok'));

                            $data['email'] = Input::get('email_newp');
                            $data['newpass'] = Input::get('password');

                            Mail::send('emails.confirmation_pass', $data, function($message)
                            {
                                $message->to(Input::get('email_newp'))->subject('Confirmation of password reset');
                            });

            
                        }
                        else
                        {
                           Notification::success(Lang::get('labels.message-newpassword-error'));
                        }
                    }
                    else
                    {
                        Notification::success(Lang::get('labels.message-code-error'));
                    }

                     return Redirect::route('login');

                }
                catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
                {
                    Notification::error(Lang::get('labels.message-user-notfound'));
                    return Redirect::route('newpassword');
                    
                }
               

       
           
        }



 
    }
