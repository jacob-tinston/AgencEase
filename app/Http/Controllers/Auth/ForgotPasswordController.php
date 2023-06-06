<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()) {
            return redirect()->route('auth.login');
        }
        
        return view('central.auth.forgot-password');
    }

    public function show(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
}
