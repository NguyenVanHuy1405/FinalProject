<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Yajra\Datatables\Datatables;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index(){
        return view(
            'admin.account.index',
            [
                'roles' => Role::all()
            ]
        );
    }
    public function getDtRowData(Request $request)
    {
        $users = User::all();
        return DataTables::of($users)
            ->editColumn('name', function ($data) {
                return $data->name;
            })
            ->editColumn('email', function ($data) {
                return $data->email;
            })
            ->editColumn('role', function ($data) {
                return $data->role->role_name;
            })
            ->editColumn('is_lock', function ($data) {
                if ($data->is_lock == 0) 
                {
                    return' <a class="fa-thumb-styling fa fa-thumbs-down btn-lg" href="' . route("admin.account.unban_account", $data->id).'"></a>';
                }
            else
                {
                    return' <a class="fa-thumb-styling fa fa-thumbs-up btn-lg" href="' . route("admin.account.ban_account", $data->id).'"></a>';
                }
            })
            ->editColumn('action', function ($data) {
                return '
                <a class="btn btn-warning btn-sm rounded-pill" href="' . route("admin.account.update", $data->id) . '"><i class="fa-solid fa-pen-to-square" title="Edit Account"></i> Edit</a>
                <form method="GET" action="' . route('admin.account.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                ' . method_field('GET') .
                    '' . csrf_field() .
                    '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this kind of room ?\')"><i class="fa-solid fa-trash" title="Delete Mission"></i>Delete</button>
                </form>
                ';
            })
            ->rawColumns(['action','is_lock'])
            ->setRowAttr([
                'data-row' => function ($data) {
                    return $data->id;
                }
            ])
            ->make(true);
    }
    public function create(AccountRequest $request)
    {
        //todo: Add create user request
        $name = $request->name;
        $email = $request->email;
        $role_id = $request->role_id;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;
        $token = Str::random(10);
        $new_user = User::create([
            'name' => $name,
            'email' => $email,
            'role_id' => $role_id,
            'password' => Hash::make($password),
            'remember_token' => $token
        ]);
        return redirect()->back()->with('success', 'User created!');
    }
    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'User deleted!');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $role_id = Role::orderBy('id','desc')->get();
        return view('admin.account.edit', compact('user', 'role_id'));
    }

    public function update(UpdateAccountRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $name = $request->name;
        $role_id = $request->role_id;
        $user->update([
            'name' => $name,
            'role_id' => $role_id
        ]);
        $user->save();
        return redirect('/admin/account/index')->with('success','Update account successfully');
    }

}
