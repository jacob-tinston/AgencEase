<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Central\CentralUser;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()) {
            return redirect()->route('auth.login');
        }
        
        return view('central.auth.password-reset.request');
    }

    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                ? back()->with('success', __($status))
                : back()->with('error', __($status));
    }

    public function show(Request $request, $token)
    {
        return view('central.auth.password-reset.reset', ['token' => $token]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                ? redirect()->route('auth.login')->with('success', __($status))
                : redirect()->back()->with('error', __($status));
    }
}
