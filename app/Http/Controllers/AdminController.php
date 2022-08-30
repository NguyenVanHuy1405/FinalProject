<?php

namespace App\Http\Controllers;
use App\Models\Admin; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    } 
    public function login(){
        return view('admin.login');
    }
    public function login_post(Request $request){
        $email = $request->email;
        $password = md5($request->password);
        $result = Admin::where('email',$email)->where('password',$password)->first();
        if($result){
            Session::put('name',$result->name);
            Session::put('id',$result->id);
            Session::put('email',$result->email);
            return Redirect::to('/admin/dashboard');
        }else{
            return Redirect::to('/admin/login')->with('message','Email or password is not correct. Please try again!!!');
        }
    }
}
