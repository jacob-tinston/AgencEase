<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CentralUser;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function show(Request $request)
    {
        // Get currently authenticated user
        if ($user = $request->user()) {
            return redirect()->route('login');
        }

        return view('central.auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'organization' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
           
        $data = $request->all();
        
        // $domain = Str::slug($data['organization'], '-') . '-' . Str::random(6);
        $domain = Str::slug($data['organization'], '-');

        $tenant = Tenant::create([
            'organization' => $data['organization'],
        ]);
        $tenant->domains()->create([
            'domain' => $domain,
            'is_primary' => true,
        ]);

        $global_id = Str::random(20);

        auth()->login(
            CentralUser::create([
                'global_id' => $global_id,
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ])
        );

        $tenant->run(function() use($data, $global_id) {
            User::create([
                'global_id' => $global_id,
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        });

        return redirect(tenant_route($domain . '.' . config('tenancy.main_domain'), 'dashboard'));
    }
}
