<?php

namespace App\Http\Controllers;

use Auth;

class HomeController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        // assign role
        // $role = Role::where('slug', 'super-admin')->first();
        // $user->roles()->attach($role);
        // dd($user->hasRole('admin'));
        // Assign Permissions
        // $permission = Permission::first();
        // $user->permissions()->attach($permission);
        // dd($user->can('add-post'));
        // dd($user->roles);
        return view('dashboard');
    }
}
