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
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('admin.dashboard');
    } 
    public function login(){
        return view('admin.login');
    }
}
