<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PhoneChangeRequest;
use App\Http\Requests\PasswordChangeRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();

        //Get user's role
        $user_role = DB::table('roles')->select('role_name')->where('id', $user->role_id)->value('role_name');
        // echo '<pre>';
        // print_r($user_role);
        // echo '</pre>';
        return view('user.index', compact('user', 'user_role'));
    }

    public function uploadAvatar(Request $request)
    {
        $user = Auth::user();
        $pre_avatar_name = $user->avatar;
        //Delete previous avatar
        $directory = 'public/home/image/' . $pre_avatar_name;
        Storage::delete($directory);
        if($request->hasFile('image')){
            $imgName = $request->image->getClientOriginalName();
            $request->image->storeAs('image',$imgName,'public');
            User::where('id', $user->id)->update(['avatar' => $imgName]);
        }
        return redirect()->back()->with('success','Avatar is changed successfully!');
    }
    public function changePhoneNumber(PhoneChangeRequest $request)
    {
        $user = Auth::user();
        $phoneNumber = $request['new-phone-number'];
        $user->phone_number = $phoneNumber;
        User::where('id', $user->id)->update(['phone_number' => $user->phone_number]);
        return redirect()->back()->with('success','The phone number is updated!');
    }
    public function changePassword()
    {
        return view('user.changepassword');
    }

    public function updatePassword(PasswordChangeRequest $request)
    {
        $user = Auth::user();
        //If two passwords are the same
        //Hash::check --> Check whether the old password entered by user is correct or not
        if(!(Hash::check($request['old-password'], $user->password))) {
            return redirect()->back()->with('message','The password currently used does not matches with the provided password.');
        }       
        //Sring compare: Old password and the new one
        if(strcmp($request['old-password'], $request['new-password']) == 0){
            return redirect()->back()->with('message','The new password cannot be the same with current password.');
        }
        //bcrypt --> password-hashing function
        $user->password = bcrypt($request['new-password']);
        User::where('id', $user->id)->update(['password' => $user->password]);
        return redirect()->back()->with('success','Password changed successfully !');
    }


}
