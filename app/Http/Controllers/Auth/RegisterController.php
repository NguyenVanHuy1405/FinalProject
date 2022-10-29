<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRegisterRequest as CustomerRequest;
use App\Http\Requests\LoginCustomerRequest as LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Jobs\SendVerifyAccount;
use App\Jobs\SendMailResetPasswordAccount;
use App\Models\Role;
use App\Models\Social;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Session;
use Socialite;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function form_login()
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
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (auth()->check() && (auth()->user()->is_lock == 3)) {
                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return redirect()->back()->with('error', 'The account has not been confirmed,<a href="'. route('getAccount') . '"><b class="click"> Click here</b></a>  to active your account');
            }
            return Redirect::to('/');
        }
        return Redirect::to('/login')->with('message', 'Email or password is not correct. Please try again!');
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

    //facebook loginCustomer 
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

   //google loginCustomer
   public function login_google()
   {
       return Socialite::driver('google')->redirect();
   }

   public function callback_google()
   {
      $user = Socialite::driver('google')->user();

      $this->login_user_google($user);
      return redirect('/checkout');
   }
   protected function login_user_google($data)
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
   public function forget_password(){
    return view('auth.forgetPassword');
   }
   public function post_forget_password(ResetPasswordRequest $request)
   {
       $user = User::where('email', '=', $request->email)->first();
       $token = strtoupper(Str::random(10));
       $user ->update(['token' => $token]);
       SendMailResetPasswordAccount::dispatch($user)->delay(now());
       return redirect()->back()->with('success', 'Please check mail to change new password');
   }
   public function get_password(User $user, $token){
    if($user->token === $token){
        return view('auth.resetpassword');
    }
    return abort('404');
   }
   public function post_password(User $user, $token,Request $request){
    $request -> validate([
        'password' =>'required|min:8',
        'password_confirmation' =>'required|same:password'
    ]);

    $new_password = Hash::make($request->password);
    $user->update(['password' => $new_password,'token' => null]);
    return Redirect::to('/loginCustomer')->with('success','Reset password successfully');
   }
   public function get_account(){
    return view('auth.activeAccount');
   }
   public function post_account(ResetPasswordRequest $request){
    $new_user = User::where('email', '=', $request->email)->first();
    $token = strtoupper(Str::random(10));
    $new_user ->update(['token' => $token]);
    SendVerifyAccount::dispatch($new_user)->delay(now());
    return redirect()->back()->with('success', 'Please check your email to active account. Thank you!!!');

   }


}
