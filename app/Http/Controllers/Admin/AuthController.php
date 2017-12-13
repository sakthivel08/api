<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input, View, Redirect, Validator, Auth, File;


class AuthController extends Controller
{
    protected $rules = [ 'email' => 'required|email', 'password' => 'required|min:6', ];

    public function getLogin(){ return view('admin.auth.login'); }

    public function postLogin(Request $request){
        try{
            $validator = Validator::make($request->all(), $this->rules);
            if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
            if(Auth::guard('admins')->attempt($request->only(['email', 'password'], $request->get('remember')))){
            return redirect('/admin')->withMessage(trans('messages.LoggedInSuccessfully'));
            }
            return redirect()->back()->withError(trans('messages.Incorrectemailpassword'))->withInput();
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
