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
		$password = $request->input('password');

		if(empty($username) || empty($password)){
			return response(["message"=>"Username and password required!","status"=>401]);
		}else{
			if(!Auth::attempt(['username'=>$username,'password'=>$password], true)){
				return response(["message"=>"Incorrect username or password!","status"=>401]);
			}
		}

		return $next($request);		
	}

}
