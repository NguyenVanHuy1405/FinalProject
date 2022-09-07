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

class RegisterController extends Controller
{
    public function register_user()
    {
        return view(
            'auth.register',
            [
                'roles' => Role::where('name',Role::ROLE_STAFF)
            ]
        );
    } 
    public function create(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;
        $phone = $request->phone;
        $token = Str::random(10);
        $new_user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'phone' => $phone,
            'remember_token' => $token,
        ]);
        return redirect()->back()->with('success', 'User created!');
    }
}
