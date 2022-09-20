<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRegisterRequest as CustomerRequest;
use App\Http\Requests\LoginCustomerRequest as LoginRequest;
use App\Jobs\SendVerifyAccount;
use App\Models\Role;
use App\Models\Social;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Session;
use Socialite;

class RegisterController extends Controller
{
    public function login_user()
    {
        return view(
            'auth.loginCustomer',
            [
                'roles' => Role::where('role_name', Role::ROLE_USER),
            ]
        );
    }
    public function register_user()
    {
        return view(
            'auth.register',
            [
                'roles' => Role::where('role_name', Role::ROLE_USER),
            ]
        );
    }
    public function customer_login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (auth()->check() && (auth()->user()->is_lock == 3)) {
                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return redirect()->back()->with('message', 'The account has not been confirmed, please confirm the account to use on the system.');
            }
            return Redirect::to('/checkout');
        }
        return Redirect::to('/loginCustomer')->with('message', 'Email or password is not correct. Please try again!');
    }
    public function create(CustomerRequest $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;
        $role_id = Role::where('role_name', Role::ROLE_USER)->first()->id;
        $phone = $request->phone;
        $is_lock = "3";
        $remember_token = Str::random(10);
        $token = strtoupper(Str::random(10));
        $new_user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role_id' => $role_id,
            'phone_number' => $phone,
            'remember_token' => $remember_token,
            'token' => $token,
            'is_lock' => $is_lock,
        ]);
        SendVerifyAccount::dispatch($new_user)->delay(now());
        return redirect()->back()->with('success', 'Account create successfully, please confirm to use it');
    }
    public function active_account(User $user, $token)
    {
        if ($user->token === $token) {
            $user->update(['is_lock' => 1, 'token' => null]);
            return Redirect::to('/loginCustomer')->with('success', 'You have successfully activated your account');
        } else {
            return Redirect::to('/loginCustomer')->with('message', 'Your verification code is not valid.');
        }
    }
    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
       $user = Socialite::driver('facebook')->user();

       $this->login_user_facebook($user);
       return redirect('/checkout');
    }
    protected function login_user_facebook($data)
    {
       $role_id = Role::where('role_name', Role::ROLE_USER)->first()->id;
       $user = User::where('email','=', $data->email)->first();
       if (!$user) {
        $user = new User();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->provider_id = $data->id;
        $user->password ='';
        $user->role_id = $role_id;
        $user->avatar = $data->avatar;
        $user->save();
    }
    Auth::login($user);
}
}
