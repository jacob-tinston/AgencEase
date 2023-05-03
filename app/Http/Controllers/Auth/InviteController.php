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
    public function create(Request $request)
    {
        $roles = $request->role ? [$request->role] : Role::all()->pluck('name');

        return view('tenant.settings.users.invite.create')->with([
            'roles' => $roles,
            'email' => $request->email ?? null,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'string|max:255',
        ]);

        do {
            $token = Str::random();
        } while (Invite::where('token', $token)->first());

        $invite = Invite::create([
            'role' => $data['role'],
            'email' => $data['email'],
            'token' => $token,
        ]);

        dispatch(new SendInvite($invite, $data['email']));

        return redirect()->route('users.index')->with('success', 'User Invited Successfully.');
    }
}
