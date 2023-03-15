<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function show(Request $request)
    {
        if (auth()->user()) {
            return redirect()->route('auth.login');
        }

        return view('central.auth.register');
    }

    public function store(Request $request)
    {
        $request->domain = Str::slug($request->domain, '-');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'organization' => 'required|string|max:255',
            'domain' => 'required|string|max:63|unique:domains|regex:(^[a-z0-9]+(?:-[a-z0-9]+)*$)',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['global_id'] = Str::random(20);

        $domain = $data['domain'];
        unset($data['domain']);

        $tenant = Tenant::create($data + [
            'ready' => false,
        ]);

        $tenant->domains()->create([
            'domain' => $domain,
            'is_primary' => true,
        ]);

        $domain = $domain.'.'.config('tenancy.main_domain');

        // $token = tenancy()->impersonate($tenant, 1, tenant_route($domain, 'dashboard'), 'web')->token;

        // return redirect(tenant_route($domain, 'impersonate', ['token' => $token]));

        return redirect(tenant_route($domain, 'dashboard'));
    }
}
