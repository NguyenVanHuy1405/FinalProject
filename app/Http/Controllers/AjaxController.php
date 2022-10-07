<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
class AjaxController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ],[
            'email.required' =>'The email can not be blank',
            'email.email' =>'The email address is not in the correct format',
            'password.required' =>'The password can not be blank',
            'email.exists' =>'Email address does not exist on the system'
        ]);

        if($validator->passes()){
            $data = $request->only('email','password');
            $check_login = Auth::attempt($data);
            if($check_login){
                if(Auth::user()->is_lock == 3){
                    Auth::logout();
                    return response()->json(['error' => ['You account is not active.']]);
                }
                return response()->json(['data' =>Auth::user()]);
            }  
        }
        return response()->json(['error' =>$validator->errors()->all()]);
    }
}
