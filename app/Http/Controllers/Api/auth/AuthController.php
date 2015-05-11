<?php namespace App\Http\Controllers\Api\auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\User as Users;

class AuthController extends Controller {

	
	/**
	 * Class constructor.
	 *
	 */
	public function __construct()
	{
		$this->middleware('zup_auth');
	}

	/**
	 * API User Authentication
	 * 
	 * @return Response
	 */
	public function run(Request $request)
	{
		$users = Users::where('username', '=', $request->input('username'))->get();

		$userData = [];
		foreach($users as $user){
			$userData['id'] = $user->id;
			$userData['name'] = $user->name;
			$userData['email'] = $user->email;
			$userData['username'] = $user->username;
			$userData['remember_token'] = $user->remember_token; 
		}

		return response(["message"=>"You are logged in!","user_data"=>$userData,"status"=>200]);
	}

}
