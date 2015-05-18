<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Http\Request;
use Illuminate\Http\Response;

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//Authenticate
Route::group(['prefix' => 'api/v1','namespace' => 'Api\v1\auth'], function()
{
	Route::get('user/auth',function(Request $request){

		$username = $request->route('username');
		$email = $request->route('email');
		$login = !empty($username) ? $username : $email;

		if(empty($login) || empty($request->route('password')))
		{
			return response()->json(["message"=>"Username/Email and password required!","status"=>401]);
		}
	});
	Route::post('user/auth', ['as' => 'auth', 'uses' => 'AuthController@run']);	
});

Route::group(['prefix' => 'api/v1','namespace' => 'Api\v1\message'], function()
{
	Route::get('message/compose',function(Request $request){
		if(empty($request->route('receiver')) || empty($request->route('sender')) || empty($request->route('message')))
		{
			return response()->json(["message"=>"All fields are required!","status"=>401]);
		}
	});
	Route::post('message/compose', ['as' => 'compose', 'uses' => 'MessageController@send_message']);

	Route::get('message/getAll', ['as' => 'getAll', 'uses' => 'MessageController@get_all_message']);
	Route::get('message/getUnreadCount', ['as' => 'getUnreadCount', 'uses' => 'MessageController@get_unread_message_count']);
	Route::get('message/read', ['as' => 'read', 'uses' => 'MessageController@read_message']);
});
