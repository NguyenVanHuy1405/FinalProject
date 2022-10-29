<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\Comment;
use App\Models\Role;
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
            $get_user_role_id = Role::where('role_name', Role::ROLE_USER)->first()->id;
            if($check_login){
                if(Auth::user()->is_lock == 3){
                    Auth::logout();
                    return response()->json(['error' => ['You account is not active.']]);
                }
                return response()->json(['data' => Auth::user()]);
            }  
        }
        return response()->json(['error' =>$validator->errors()->all()]);
    }
    public function login_to_checkout(Request $request){
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
            $get_user_role_id = Role::where('role_name', Role::ROLE_USER)->first()->id;
            if($check_login){
                if(Auth::user()->is_lock == 3){
                    Auth::logout();
                    return response()->json(['error' => ['You account is not active.']]);
                } 
                if(Auth::user()->role_id != $get_user_role_id){
                    Auth::logout();
                    return response()->json(['error' => ['Please login with your customer account']]);
                }
                return response()->json(['data' => Auth::user()]);
            }  
        }
        return response()->json(['error' =>$validator->errors()->all()]);
    }
    public function comment($room_id,Request $request){
        $user_id = Auth::id();
        $validator = Validator::make($request->all(), [
            'content' => 'required'
        ],[
            'content.required' =>'The content comment can not be blank'
        ]);
        if($validator->passes()){
            $data = [
                'user_id' => $user_id,
                'room_id' => $room_id,
                'content' => $request->content,
                'reply_id' => $request->reply_id ? $request->reply_id : 0
            ];
            if($comment = Comment::create($data)){
                $comments = Comment::where(['room_id' => $room_id,'reply_id' => 0 ])->orderBy('id','DESC')->get();
                return view('booking.list_comment',compact('comments'));
            }  
        }
        return response()->json(['error' =>$validator->errors()->first()]);
    }
}
