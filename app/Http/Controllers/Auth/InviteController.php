<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendInvite;
use App\Models\Tenant\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class InviteController extends Controller
{
    public function create()
    {
        $roles = Role::all()->pluck('name');

        return view('tenant.settings.users.invite.create')->with([
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        do {
            $token = Str::random();
        } while (Invite::where('token', $token)->first());

        $invite = Invite::create([
            'role' => $request->role,
            'email' => $request->get('email'),
            'token' => $token,
        ]);

        dispatch(new SendInvite($invite, $request->get('email')));

        return redirect()->route('users.index')->with('success', 'User Invited Successfully');
    }
}
