<?php namespace App\Http\Controllers\Api\v1\auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\User as Users;

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
		$username = $request->input('username');
		$email = $request->input('email');
		$login = !empty($username) ? $username : $email;
		
		if(!filter_var($login, FILTER_VALIDATE_EMAIL)){
			$users = Users::where('username', '=', $login)->get();
		}else{
			$users = Users::where('email', '=', $login)->get();
		}
		

		$userData = [];
		foreach($users as $user){
			$userData['id'] = $user->id;
			$userData['name'] = $user->name;
			$userData['email'] = $user->email;
			$userData['username'] = $user->username;
			$userData['remember_token'] = $user->remember_token; 
		}

		return response()->json(["message"=>"You are logged in!","user_data"=>$userData,"status"=>200]);
	}

}
