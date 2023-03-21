<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
        // return view('tenant.settings.users.manage-users')->with([
        //     'users' => $users
        // ]);
    }
}
