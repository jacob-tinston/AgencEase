<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invite;
use App\Mail\InviteCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class InviteController extends Controller
{
    public function show()
    {
        $roles = Role::all()->pluck('name');
        return view('tenant.settings.users.invite-user')->with([
            'roles' => $roles
        ]);
    }
    
    public function create(Request $request)
    {
        do {
            $token = Str::random();
        }
        while (Invite::where('token', $token)->first());
     
        $invite = Invite::create([
            'email' => $request->get('email'),
            'token' => $token
        ]);
     
        Mail::to($request->get('email'))->send(new InviteCreated($invite));

        return redirect()->route('users.manage')->with('success', 'User Invited Successfully');
    }
    
    public function store($token)
    {
        if (! $invite = Invite::where('token', $token)->first()) {
            abort(404);
        }
     
        // User::create(['email' => $invite->email]);
     
        $invite->delete();
     
        return 'Good job! Invite accepted!';
    }
}
