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
        $request->domain = Str::slug($request->domain, '-');
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'organization' => 'required|string|max:255',
            'domain' => 'required|string|max:63|unique:domains|regex:(^[a-z0-9]+(?:-[a-z0-9]+)*$)',
            'password' => 'required|string|min:8|confirmed',
        ]);
           
        $data = $request->all();

        $tenant_initials = $this->initials($data['organization']);

        $tenant = Tenant::create([
            'organization' => $data['organization'],
            'initials' => $tenant_initials,
        ]);
        $tenant->domains()->create([
            'domain' => $data['domain'],
            'is_primary' => true,
        ]);

        $global_id = Str::random(20);
        $initials = $this->initials($data['name']);

        auth()->login(
            CentralUser::create([
                'global_id' => $global_id,
                'name' => $data['name'],
                'initials' => $initials,
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ])
        );

        $tenant->run(function() use($data, $global_id, $initials) {
            User::create([
                'global_id' => $global_id,
                'name' => $data['name'],
                'initials' => $initials,
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        });

        return redirect(tenant_route($data['domain'] . '.' . config('tenancy.main_domain'), 'dashboard'));
    }

    /**
     * Generate initials from a name
     *
     * @param string $name
     * @return string
     */
    protected function initials(string $name) : string
    {
        $words = explode(' ', $name);
        if (count($words) >= 2) {
            return mb_strtoupper(
                mb_substr($words[0], 0, 1, 'UTF-8') . 
                mb_substr(end($words), 0, 1, 'UTF-8'), 
            'UTF-8');
        }
        return $this->makeInitialsFromSingleWord($name);
    }

    /**
     * Make initials from a word with no spaces
     *
     * @param string $name
     * @return string
     */
    protected function makeInitialsFromSingleWord(string $name) : string
    {
        preg_match_all('#([A-Z]+)#', $name, $capitals);
        if (count($capitals[1]) >= 2) {
            return mb_substr(implode('', $capitals[1]), 0, 2, 'UTF-8');
        }
        return mb_strtoupper(mb_substr($name, 0, 2, 'UTF-8'), 'UTF-8');
    }

}
