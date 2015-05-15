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
			return response()->json(["message"=>$this->error_message,"status"=>400]);
		}else{
			$message = new Message;
			$message->sender_id = $this->get_user_id_by_username($sender);
			$message->receiver_id = $this->get_user_id_by_username($receiver);
			$message->message = $message_sent;
			$message->save();
			return response()->json(["message"=>"Message successfully sent!","status"=>200]);
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

	public function get_message(Request $request){
		$receiver = $request->input('user_id');
		if(empty($receiver)){
			return response()->json(["message"=>"Can't fetch messages, receiver's id is missing!","status"=>401]);
		}
		$messages = Message::where('receiver_id', '=', $receiver)->get();
		return response()->json(["message"=>$messages,"status"=>200]);
	}

	public function get_unread_message_count(Request $request){
		$receiver_id = $request->input('user_id');
		if(empty($receiver_id)){
			return response()->json(["message"=>"Can't fetch result, receiver's id is missing!","status"=>401]);
		}
		$count = Message::whereRaw('receiver_id = ? and status = 0',[$receiver_id])->count();
		return response()->json(["count"=>$count,"status"=>200]); 
	}

	public function read_message(Request $request){
		$id = $request->input('message_id');
		$receiver_id = $request->input('user_id');

		if(empty($id)){
			return response()->json(["message"=>"Unable to display this message! Message id missing!","status"=>401]);
		}
		if(empty($receiver_id)){
			return response()->json(["message"=>"Unable to display this message! Receiver's id missing!","status"=>401]);
		}

		if(empty($id) && empty($receiver_id)){
			return response()->json(["message"=>"Unable to display this message! Receiver's id and Message id missing!","status"=>401]);
		}

		$affectedRows = Message::whereRaw('id = ? and receiver_id = ?',[$id,$receiver_id])->update(['status' => 1]);
		if($affectedRows > 0 ){
			$messages = Message::whereRaw('id = ? and receiver_id = ?',[$id,$receiver_id])->get();
			return response()->json(["message"=>$messages,"status"=>200]);
		}
		return response()->json(["message"=>"Unable to display this message!","status"=>401]);
	}

}
