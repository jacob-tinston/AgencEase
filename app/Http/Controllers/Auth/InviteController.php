<?php

namespace App\Http\Controllers\Auth;

use App\Models\CentralUser;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Invite;
use App\Mail\InviteCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class InviteController extends Controller
{
    public function show($token = null)
    {
        if (! $token) {
            $roles = Role::all()->pluck('name');

            return view('tenant.settings.users.invite-user')->with([
                'roles' => $roles
            ]);
        }

        $invite = Invite::where('token', $token)->first();

        if (!$invite || auth()->user()) {
            abort(404);
        }

        return view('tenant.settings.users.accept-invitation')->with('token', $token);
    }
    
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        do {
            $token = Str::random();
        }
        while (Invite::where('token', $token)->first());
     
        $invite = Invite::create([
            'role' => $request->role,
            'email' => $request->get('email'),
            'token' => $token
        ]);
     
        Mail::to($request->get('email'))->send(new InviteCreated($invite));

        return redirect()->route('users.manage')->with('success', 'User Invited Successfully');
    }
    
    public function store(Request $request, $token)
    {
        if (! $invite = Invite::where('token', $token)->first()) {
            abort(404);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data['email'] = $invite->email;
        $data['password'] = Hash::make($data['password']);

        $global_id = CentralUser::where('email', $data['email'])->pluck('global_id')->first();
        $data['global_id'] = $global_id ?? Str::random(20);

        User::create($data)->assignRole($invite->role);
     
        $invite->delete();
     
        return redirect()->route('dashboard');
    }
}
