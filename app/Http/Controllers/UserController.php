<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
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
        $directory = 'public/image/' . $pre_avatar_name;
        Storage::delete($directory);
        if($request->hasFile('image')){
            $imgName = $request->image->getClientOriginalName();
            $request->image->storeAs('images',$imgName,'public');
            User::where('id', $user->id)->update(['avatar' => $imgName]);
        }
        return redirect()->back()->with(['class' => 'success', 'message' => 'Avatar is changed successfully!']);
    }
}
