<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Central\CentralUser;
use App\Models\Tenant\Contact;
use App\Models\Tenant\Invite;
use App\Models\Tenant\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request, $search_term = '')
    {
        $order_by_col = $request->sort ? 'name' : 'created_at';
        $order_by = $request->sort ?? 'desc';
        $users = User::where('name', 'LIKE', "%$search_term%")
            ->orWhere('email', 'LIKE', "%$search_term%")
            ->orderBy($order_by_col, $order_by)
            ->paginate(auth()->user()->per_page);

        return view('tenant.settings.users.index')->with([
            'users' => $users,
        ]);
    }

    public function create($token)
    {
        $invite = Invite::where('token', $token)->first();

        if (! $invite || auth()->user()) {
            abort(404);
        }

        return view('tenant.settings.users.invite.accept')->with('token', $token);
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
        $data['global_id'] = Str::random(20);

        $user = User::create($data)->assignRole($invite->role);

        if ($contact = Contact::where('email', $data['email'])->first()) {
            $user->contact()->save($contact);
        }

        $invite->delete();

        return redirect()->route('dashboard');
    }

    public function edit(Request $request)
    {
        return view('tenant.settings.profile.edit');
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
            $avatarPath = $request->avatar->storeAs('/avatars', $fileName, 'public');
        }

        $user = User::find(auth()->user()->id);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'avatar' => $avatarPath ?? $user->avatar,
        ]);

        return back()->with('success', 'Profile Updated Successfully.');
    }

    public function editPassword(Request $request)
    {
        return view('tenant.settings.profile.edit-password');
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

        return back()->with('success', 'Password Changed Successfully.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $central_user = CentralUser::where('global_id', $user->global_id)->first();

        if ($user->id == auth()->user()->id || in_array('Super Admin', $user->roles->pluck('name')->toArray())) {
            return redirect()->back()->with('error', 'Cannot delete this user.');
        }

        if ($contact = $user->contact) {
            $contact->user_id = null;
            $contact->push();
        }

        $user->delete();
        $central_user->delete();

        return redirect()->back()->with('success', 'User Deleted Successfully.');
    }

    public function search(Request $request)
    {
        $request->validate([
            'term' => 'string',
        ]);

        if (! $term = $request->term) {
            return redirect()->back();
        }

        return $this->index($request, $term);
    }

    public function perPage(Request $request)
    {
        $user = User::find($request->id);
        $user->per_page = $request->per_page;
        $user->save();

        return redirect()->back();
    }
}
