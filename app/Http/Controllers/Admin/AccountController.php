<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Yajra\Datatables\Datatables;

class AccountController extends Controller
{
    public function index(){
        return view(
            'admin.account.index',
            [
                'roles' => Role::all(),
            ]
        );
    }
    public function getDtRowData(Request $request)
    {
        $users = User::join('roles','roles.id','=','users.role_id')->orderBy('users.id','desc')->get();
        return Datatables::of($users)
            ->editColumn('name', function ($data) {
                return $data->name;
            })
            ->editColumn('email', function ($data) {
                return $data->email;
            })
            ->editColumn('role_name', function ($data) {
                return $data->role_name;
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
                $res = "";
                if (auth()->user()->hasRole(Role::ROLE_ADMIN)) {
                    $res .= ' <a class="btn btn-warning btn-sm rounded-pill" href="' . route("admin.account.update", $data->id) . '"><i class="fa-solid fa-pen-to-square" title="Edit Account"></i></a>
                        <form method="POST" action="' . route('admin.account.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                        ' . method_field('DELETE') .
                        '' . csrf_field() .
                        '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this account ?\')"><i class="fa-solid fa-trash-can" title="Delete Account"></i></button>
                        </form>';
                }
                return $res;
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
        $token = Str::random(10);
        $new_user = User::create([
            'name' => $name,
            'email' => $email,
            'role_id' => $role_id,
            'department_id' => $department_id,
            'password' => Hash::make($password),
            'remember_token' => $token
        ]);
        SendEmailCreateAccount::dispatch($new_user, $password)->delay(now());
        return redirect()->back()->with('flash_message', 'User created!');
    }

}
