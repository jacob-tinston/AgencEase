<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return view('tenant.profile.manage-profile');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users',
        ]);

        $user = User::find(auth()->user()->id);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email']
        ]);
        
        return back()->with('success', 'Profile Updated');
    }

    public function updateOrganization(Request $request)
    {
        $data = $request->validate([
            'organization' => 'string|max:255',
        ]);

        $tenant = Tenant::find(tenant('id'));

        $tenant->update([
            'organization' => $data['organization']
        ]);
        
        return back()->with('success', 'Organization Updated');
    }

    public function changePassword(Request $request)
    {
        return view('tenant.profile.change-password');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if(! Hash::check($data['current_password'], auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match");
        }

        $user = User::find(auth()->user()->id);

        $user->update([
            'password' => Hash::make($data['password'])
        ]);

        return back()->with('success', 'Password Changed');
    }
}
