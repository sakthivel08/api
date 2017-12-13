<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator, Redirect, Auth, Hash ;


class AuthController extends Controller {


	public function register(Request $request){
		$data = $request->all();
		$validator = Validator::make($data, [
			'firstname' => 'required|min:2|max:191','lastname' => 'required|min:2|max:191',
			'email' => 'required|email|max:191','password' => 'required|confirmed|min:6|max:25', 
		]);
		if($validator->fails()) return response()->json(['errors' => $validator->errors(), 'validation' => true, ], 400);
		try{
			$user = \App\User::where('email', '=', $request->get('email'))->first();
			if($user) return response()->json(['error' => trans("messages.Emailalreadyregistered"), ], 400);
			else{
				$data['password'] = Hash::make($data['password']);
				$api = getApiToken();
				if($api['error']){ return response()->json([ "error" => $api['exception']->getMessage(), "status" => false, ], 400); }
				$data['api_token'] = $api['token'];
				$user = \App\User::create($data);
				if($user){
					return response()->json([ 'status' => true, 'success' => true, "api_token" => $api['token'], 'data' => $user, 'message' => trans("messages.RegisteredSuccessfully"), ], 201);
				}
				return response()->json([ 'status' => false, 'success' => false, 'error' => trans("messages.SomethingwentWrong"), ], 400);
			}
		}catch(Exception $e){
			return response()->json(['error' => $e->getMessage(), ], 400);
		}
	}


	public function login(Request $request){
		$data = $request->all();
		$validator = Validator::make($data, [ 'email' => 'required',
			'password' => "required" ,
			]);
		$password = $request->input('password');
		$email = $request->input('email');
		if($validator->fails()) return response()->json(['errors' => $validator->errors(), 'validation' => true, ], 400);
		$user = \App\User::where('email', '=', $request->get('email'))->first();
		if(!$user) return response()->json(['error' => trans('messages.Incorrectemailpassword'), ], 400);
		else{
			if(Auth::attempt(['email' => $email, 'password' => $password])){
				try{
					$api = getApiToken();
					if($api['error']){ return response()->json([ "error" => $api['exception']->getMessage(), "status" => false, ], 400); }
					$user->update([ "api_token" => $api['token'],]);
					return response()->json([ "api_token" => $api['token'],
						'message' => trans("messages.LoggedInSuccessfully"), ], 201);
				}catch(\Exception $e){
					return response()->json([ "error" => $e->getMessage(), "status" => false, ], 400);
				}
			}	
		}
		return response()->json([ "error" => trans("messages.PleaseCheckEmailPassword"), "status" => false, ], 400);
	}
}
