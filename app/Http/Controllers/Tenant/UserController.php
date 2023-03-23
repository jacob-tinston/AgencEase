<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\CentralUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $users = User::all();

        return view('tenant.settings.users.manage-users')->with([
            'users' => $users,
        ]);
    }

    public function edit(Request $request)
    {
        if ($request->id == auth()->user()->id) {
            return redirect()->route('profile.manage');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $central_user = CentralUser::where('global_id', $user->global_id)->first();

        if ($user->id == auth()->user()->id || in_array('Super Admin', $user->roles->pluck('name')->toArray())) {
            return redirect()->back()->with('error', 'Cannot delete this user.');
        }

        $user->delete();
        $central_user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
