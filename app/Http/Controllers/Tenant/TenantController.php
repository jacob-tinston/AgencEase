<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Central\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TenantController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate([
            'organization' => 'string|max:255',
            'avatar' => 'mimes:jpg,jpeg,png',
        ]);

        $avatar = $request->file('avatar');

        if ($request->hasFile('avatar') && $avatar->isValid()) {
            $fileName = Str::random().'.'.$avatar->extension();
            $avatarPath = $request->avatar->storeAs('/avatars', $fileName, 'public');
        }

        $tenant = Tenant::find(tenant('id'));

        $tenant->update([
            'organization' => $data['organization'],
            'avatar' => $avatarPath ?? tenant('avatar'),
        ]);

        return back()->with('success', 'Organization Updated Successfully.');
    }

    public function updateCustomizer(Request $request)
    {
        $tenant = Tenant::find(tenant('id'));

        $tenant->update([
            'customizer' => json_encode($request->all()),
        ]);
    }
}
