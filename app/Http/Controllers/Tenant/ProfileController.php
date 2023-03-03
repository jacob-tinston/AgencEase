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
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users',
        ]);

        $data = $request->all();

        User::whereId(auth()->user()->id)->update([
            'name' => $data['name'],
            'email' => $data['email']
        ]);
        
        return back()->with('success', 'Profile Updated');
    }

    public function updateOrganization(Request $request)
    {
        $request->validate([
            'organization' => 'string|max:255',
        ]);

        $data = $request->all();

        tenant()->organization = $data['organization'];

        tenant()->save();
        
        return back()->with('success', 'Organization Updated');
    }

    public function changePassword(Request $request)
    {
        return view('tenant.profile.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data = $request->all();

        if(! Hash::check($data['current_password'], auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($data['password'])
        ]);

        return back()->with('success', 'Password Changed');
    }
}
