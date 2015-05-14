<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

use Auth;

class ZupAuth {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{
		$username = $request->input('username');
		$email = $request->input('email');
		$login = !empty($username) ? $username : $email;
		$password = $request->input('password');

		if(empty($login) || empty($password)){
			return response(["message"=>"Username/Email and password required!","status"=>401]);
		}else{
			if (!filter_var($login, FILTER_VALIDATE_EMAIL)){
				if(!Auth::attempt(['username'=>$login,'password'=>$password], true) && !Auth::attempt(['email'=>$login,'password'=>$password], true)){
					return response()->json(["message"=>"Incorrect username/email or password!","status"=>401]);
				}
			}else{
				if(!Auth::attempt(['username'=>$login,'password'=>$password], true) && !Auth::attempt(['email'=>$login,'password'=>$password], true)){
					return response()->json(["message"=>"Incorrect username/email or password!","status"=>401]);
				}
			}
			
		}

		return $next($request);		
	}

}
