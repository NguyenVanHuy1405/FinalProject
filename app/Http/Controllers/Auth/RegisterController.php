<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CustomerRegisterRequest as CustomerRequest;
use App\Http\Requests\LoginCustomerRequest as LoginRequest;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function register_user()
    {
        return view(
            'auth.register',
            [
                'roles' => Role::where('role_name',Role::ROLE_USER)
            ]
        );
    }
    public function customer_login(LoginRequest $request){
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            return Redirect::to('/checkout');
        }
        return Redirect::to('/register')->with('error','Email or password is not correct. Please try again!');
    } 
    public function create(CustomerRequest $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;
        $role_id = Role::where('role_name',Role::ROLE_USER)->first()->id;
        $phone = $request->phone;
        $token = Str::random(10);
        $new_user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role_id' =>$role_id,
            'phone_number' => $phone,
            'remember_token' => $token,
        ]);
        return Redirect::to('/checkout');
    }
    public function checkout(){
        return view('checkout.show_checkout');
    }
}
