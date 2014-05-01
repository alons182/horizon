<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/
Route::filter('langdetection', function($route, $request, $lang = "auto")
{
 
    if($lang != "auto")
    {
        $lang = (in_array($lang, Config::get('app.available_language'))) ? $lang : Config::get('app.locale');
 
        Session::put('user_lang', $lang );
        Config::set('app.locale', $lang);
 
        return;
 
    }
    if(Session::has('user_lang'))
    {
        if(Session::has('user_lang'))
        {
            //  +   is the language set in session
            $lang = Session::get('user_lang');
 
            Log::info($lang);
        }else{
            //  +   we use the browser lang
            $lang = !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtok(strip_tags($_SERVER['HTTP_ACCEPT_LANGUAGE']), ',') : '';
            $lang = substr($lang, 0,2);
        }
 
    }
 
    $lang = (in_array($lang, Config::get('app.available_language'))) ? $lang : Config::get('app.locale');
 
    Session::put('user_lang', $lang );
    Config::set('app.locale', $lang);
 
    return;
 
});


App::before(function($request)
{
    $uri = $request->server->get('REQUEST_URI');
    foreach(Config::get('app.languages') as $language){
        if(preg_match('/^\/'.$language.'(\/|\z|\?.*|#(.*))/', $uri)){
            Config::set('app.locale', $language);
            $newUri = '/'.substr($uri, 3);
            $request->server->set('REQUEST_URI', $newUri);
        }
    }
});

/*App::before(function($request)
{
	//
});*/


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/
Route::filter('auth.admin', function()
{
    if ( ! Sentry::check())
    {
        return Redirect::route('admin.login');
    }
    $admin = Sentry::getGroupProvider()->findByName('Admin');
  	$user = Sentry::getUser();
              
                    
    if (! $user->inGroup($admin))
    {
        return Redirect::route('admin.login');
    }
    
   	
   	

                    //return Redirect::route('admin.properties.index');
             
   
});


/*Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});*/


/*Route::filter('auth.basic', function()
{
	return Auth::basic();
});*/

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});