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

Route::group(['prefix' => 'api/v1','namespace' => 'Api\auth'], function()
{
	Route::get('user/auth',function(Request $request){
		if(empty($request->route('username')) || empty($request->route('password')))
		{
			return response(["message"=>"Username and password required!","status"=>401]);
		}
	});
	Route::post('user/auth', ['as' => 'auth', 'uses' => 'AuthController@run']);	
});

Route::group(['prefix' => 'api/v1','namespace' => 'Api\message'], function()
{
	Route::get('message/send',function(Request $request){
		if(empty($request->route('receiver')) || empty($request->route('sender')) || empty($request->route('message')))
		{
			return response(["message"=>"All fields are required!","status"=>401]);
		}
	});
	Route::post('message/send', ['as' => 'send', 'uses' => 'MessageController@send_message']);
});
