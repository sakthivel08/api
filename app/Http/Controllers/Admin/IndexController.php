<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input, View, Redirect, Validator, Auth, File;

class IndexController extends Controller
{
	public function __construct(){
		$this->middleware('admins');
	}

	public function index(){
		$usersCount = \App\User::count();
		return view('admin.index', [ 'title' => 'Admin', 'usersCount' => $usersCount, ]);
	}

	public function postChangeLang(){
		$url = (URL::previous() != url('/')) ? URL::previous() : url('/admin');
	}

	public function create(){
		try{
			$admin = Admin::find(Auth::guard('admins')->user()->id);
			$title = trans('messages.Profile');
			if($admin) return view('admin.profile', compact('admin', 'title'));
			else{
			Auth::logout();
			return redirect('/admin')->withError(trans('messages.UserNotFound'));
			}
		}catch(Exception $e){
		return redirect('/admin')->withError($e->getMessage());
		}
	}

	public function store(Request $request){
		try{
			$validator = Validator::make($request->all(), [ 'firstname' => 'required|max:255',
			'lastname' => 'required|max:255', 'password' => 'nullable|confirmed|min:8|max:50',
			]);
			if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
			$admin = Admin::find(Auth::guard('admins')->user()->id);
			if($admin){
				$data = $request->only(['firstname', 'lastname',]);
				if($request->has('password') && !empty($request->input('password'))){ $data['password'] = \Hash::make($request->input('password')); }
				$insert = $admin->update($data);
				if($insert) return redirect('/admin')->withMessage(trans('messages.ProfileUpdatedSuccessfully'));
				else return redirect()->back()->withError(trans('messages.SomethingwentWrong'))->withInput();
			}else{
				Auth::logout();
				return redirect('/admin/login')->withError(trans('messages.UserNotFound'));
			}
		}catch(Exception $e){
			return redirect('/admin')->withError($e->getMessage());
		}
	}

	public function getLogout(){
		try{
			Auth::guard('admins')->logout();
			return redirect('/admin/login')->withMessage(trans("messages.LoggedOutSuccessfully"));
		}catch(Exception $e){
			return redirect('/admin')->withError($e->getMessage());
		}
	}
}
