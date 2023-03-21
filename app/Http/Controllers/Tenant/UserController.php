<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $users = User::all();
        return view('tenant.settings.users.manage-users')->with([
            'users' => $users
        ]);
    }

    public function create(Request $request)
    {
        $roles = Role::all()->pluck('name');
        return view('tenant.settings.users.invite-user')->with([
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        return redirect()->route('users.manage')->with('success', 'User Invited Successfully');
    }

    public function edit(Request $request)
    {
        if ($request->id == auth()->user()->id) {
            return redirect()->route('profile.manage');
        }
    }
}
