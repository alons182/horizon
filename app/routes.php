<?php

Event::Listen('illuminate.query', function($query)
{
    var_dump($query);
});

//login admin
Route::get('admin/logout',  array('as' => 'admin.logout',      'uses' => 'App\Controllers\Admin\AuthController@getLogout'));
Route::get('admin/login',   array('as' => 'admin.login',       'uses' => 'App\Controllers\Admin\AuthController@getLogin'));
Route::post('admin/login',  array('as' => 'admin.login.post',  'uses' => 'App\Controllers\Admin\AuthController@postLogin'));

// login front
Route::get('logout',  array('as' => 'logout',      'uses' => 'AuthController@getLogout'));
Route::get('login',   array('as' => 'login',       'uses' => 'AuthController@getLogin'));
Route::post('login',  array('as' => 'login.post',  'uses' => 'AuthController@postLogin'));



//register admin
Route::get('admin/register',   array('as' => 'admin.register',       'uses' => 'App\Controllers\Admin\AuthController@getRegister'));
Route::post('admin/register',  array('as' => 'admin.register.post',  'uses' => 'App\Controllers\Admin\AuthController@postRegister'));

//register front
Route::get('register',   array('as' => 'register',       'uses' => 'AuthController@getRegister'));
Route::post('register',  array('as' => 'register.post',  'uses' => 'AuthController@postRegister'));
Route::get('activation',  array('as' => 'activation',  'uses' => 'AuthController@getActivation'));
Route::post('activation',  array('as' => 'activation.post',  'uses' => 'AuthController@postActivation'));
Route::get('reset',  array('as' => 'reset',  'uses' => 'AuthController@getReset'));
Route::post('reset',  array('as' => 'reset.post',  'uses' => 'AuthController@postReset'));
Route::get('newpassword',  array('as' => 'newpassword',  'uses' => 'AuthController@getNewpassword'));
Route::post('newpassword',  array('as' => 'newpassword.post',  'uses' => 'AuthController@postNewpassword'));

//save & load gallery admin
Route::post('admin/properties/savegallery',  'App\Controllers\Admin\PropertiesController@postSavegallery');
Route::post('admin/properties/loadgallery',  'App\Controllers\Admin\PropertiesController@postLoad');
Route::post('admin/properties/deletegallery',  'App\Controllers\Admin\PropertiesController@postDeletegallery');

//save, load & delete favorites front
Route::post('properties/savefavorites',  'PropertiesController@savefavorites');
Route::post('properties/deletefavorites',  'PropertiesController@deletefavorites');
Route::get('properties/favorites',  'PropertiesController@favorites');

//save request front
Route::post('properties/requestproperty',  'PropertiesController@requestproperty');


Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function()
{
    Route::any('/',                'App\Controllers\Admin\PropertiesController@index');
    Route::resource('properties',       'App\Controllers\Admin\PropertiesController');
    Route::resource('categories', 'App\Controllers\Admin\CategoriesController');
    Route::resource('prequests', 'App\Controllers\Admin\PrequestsController');
    Route::resource('testimonials', 'App\Controllers\Admin\TestimonialsController');
    Route::resource('users', 'App\Controllers\Admin\UsersController');
   
 });

//

//Route::get('/', 'HomeController@index');

Route::get('about',  'HomeController@about');
Route::get('tips',  'HomeController@tips');
Route::get('contact',  'HomeController@contact');
Route::resource('homes', 'HomeController');
Route::resource('properties', 'PropertiesController');
Route::resource('testimonials', 'TestimonialsController');

Route::get('/', array(
    'as' => 'splash',
    'before' => 'langdetection:auto',
    function(){
        return Redirect::route('home-'.Config::get('app.locale'),array(), 301);
    })
);



Route::get('home', array(
    'as' => 'home-en',
    'before' => 'langdetection:en',
    'uses' => 'HomeController@index'
));
 
Route::get('inicio', array(
    'as' => 'home-es',
    'before' => 'langdetection:es',
    'uses' => 'HomeController@index'
));
// 404 Page
App::missing(function($exception)
{
    return Response::view('site::404', array(), 404);
});

/*Route::get('/mail', function(){
	$data['name'] = 'alonso';

	//Mail::pretend();
	Mail::send('emails.welcome', $data, function($message)
		{
			$message->to('alons182@hotmail.com')->subject('welcome');
		});

	return 'sent';
});*/

