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

    public function edit(Request $request)
    {
        if ($request->id == auth()->user()->id) {
            return redirect()->route('profile.manage');
        }
    }
}
