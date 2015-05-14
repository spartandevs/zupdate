<?php namespace App\Http\Controllers\Api\v1\message;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Message;
use App\User as Users;

class MessageController extends Controller {

	public $error_message = [];

	/**
	 * API User Authentication
	 * 
	 * @return Response
	 */
	public function send_message(Request $request)
	{
		$sender = $request->input('sender');
		$receiver = $request->input('receiver');
		$message_sent = $request->input('message');

		$params = ["receiver","sender","message"];
		foreach($params as $k=>$v){
			if(empty($request->input($v))){
				$this->error_message[] = "Error: ".$v. " field is required!";
			}
		}		

		if(!empty($sender) || !empty($receiver)){
			if(!$this->check_receiver_by_username($receiver)){
				$this->error_message[] = "Error: User ".$receiver." not found!";
			}
		}
		
		if(!empty($this->error_message)){
			return response(["message"=>$this->error_message,"status"=>400]);
		}else{
			$message = new Message;
			$message->sender_id = $this->get_user_id_by_username($sender);
			$message->receiver_id = $this->get_user_id_by_username($receiver);
			$message->message = $message_sent;
			$message->save();
			return response(["message"=>"Message successfully sent!","status"=>200]);
		}
		
	}
	
	public function get_user_id_by_username($username){
		$userid = "";
		$users = Users::where("username","=",$username)->get();
		foreach($users as $user){
			$userid = $user->id;
		}
		return $userid;
	}

	public function check_receiver_by_username($username){
		$count = Users::where("username","=",$username)->count();
		return $count == 0 ? false : true;
	}

}
