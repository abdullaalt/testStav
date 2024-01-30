<?php

namespace App\Http\Controllers\V1;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function returnView($tpl, $data, $json=false){
		
		$headers = getallheaders();
		$app_id = isset($headers['User-Token']) || isset($headers['user-token']);
		
		$user = Auth::user();
		$messages_controller = new MessagesController();
		$user_controller = new UserController();
		
		$data['is_limited'] = $user_controller->isUserLimited($user->id);
		
		if ($app_id){
			header('Content-Type: application/json');
			
			if (isset($data['profile'])) unset($data['profile']);
			if (isset($data['overview']))unset($data['overview']);
			if (isset($data['backurl']))unset($data['backurl']);
			if (isset($data['action']))unset($data['action']);
			
			return response()->json($data);
		}
		
		$data['user'] = $user;
		$data['lang'] = new LangController();
		$data['mc'] = $messages_controller->getNewMessagesCount();
		$data['is_moderator'] = $user->is_moder || $user->is_admin;
		
		return view($tpl, $data); 
		
	} 
	
	public function returnOrBack($message, $type, $key, $code = 200, $url = false){
		
		$headers = getallheaders();

		$app_id =isset($headers['User-Token']) || isset($headers['user-token']);
		if ($app_id){
			$this->returnJSON($message, $key, $code);
		}else{
			session()->flash('messages.'.$type, $message);
			if ($url){
				return redirect($url); 
			}else{
				return redirect()->back(); 
			}
		}
		
	}
	
	public function returnJSON($param, $key=false, $code = 200){
		
		header('Content-Type: application/json');
		if (is_array($param) || is_object($param)){
			return response()->json($param, $code);
		}else{
			return response()->json([$key=>$param], $code);
		}
		
	}
	
	public function getLangText($key){
		$lang = new LangController();
		return $lang->getLangText($key);
	}
}
