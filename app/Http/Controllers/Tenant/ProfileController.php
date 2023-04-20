<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return view('tenant.settings.profile.manage-profile');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255',
            'avatar' => 'mimes:jpg,jpeg,png',
        ]);

        $avatar = $request->file('avatar');

        if ($request->email !== auth()->user()->email) {
            $request->validate([
                'email' => 'unique:users',
            ]);
        }

        if ($request->hasFile('avatar') && $avatar->isValid()) {
            $fileName = Str::random().'.'.$avatar->extension();
            $avatarPath = $request->avatar->storeAs('app/public/media', $fileName);
        }

        $user = User::find(auth()->user()->id);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'avatar' => $avatarPath ?? null,
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
            'organization' => $data['organization'],
        ]);

        return back()->with('success', 'Organization Updated');
    }

    public function changePassword(Request $request)
    {
        return view('tenant.settings.profile.change-password');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (! Hash::check($data['current_password'], auth()->user()->password)) {
            return back()->with('error', "Old Password Doesn't match");
        }

        $user = User::find(auth()->user()->id);

        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        return back()->with('success', 'Password Changed');
    }

    public function updateCustomizer(Request $request)
    {
        $tenant = Tenant::find(tenant('id'));

        $tenant->update([
            'customizer' => json_encode($request->all()),
        ]);
    }
}
