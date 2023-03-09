<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // dd(session('imperson'));
        $page_data['users'] = User::all();
        return view('users.list', $page_data);
    }

    public function edit($id, Request $request)
    {
        $page_data['user'] = User::findOrFail($id);
        $page_data['roles'] = Role::all();
        $page_data['permissions'] = Permission::all();
        return view('users.edit', $page_data);
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $user = User::findOrFail($id);
        $role = Role::find($request->role);
        if(!$user->hasRole($role->slug))
        {
            $user->roles()->attach($role);
        }
        if($request->permissions)
        {
            foreach($request->permissions as $permission_id)
            {
                $permission = Permission::find($permission_id);
                if(!$user->hasPermission($permission))
                {
                    $user->permissions()->attach($permission);
                }
            }
        }

        return redirect()->to(route('users'));
    }
}
