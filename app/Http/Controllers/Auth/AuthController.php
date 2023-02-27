<?php

namespace App\Http\Controllers\Auth;

use App\Models\CentralUser;
use App\Models\Tenant;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function show(Request $request)
    {
        // Get currently authenticated user
        if ($user = $request->user()) {
            return $this->redirectUserToTenantOrShowTenantSelector($user);
        }

        return view('central.auth.login');
    }

    public function store(Request $request)
    {
        // Attempt authentication using the email and password from the request
        $this->authenticate($request->get('email'), $request->get('password'));

        return $this->show($request);
    }

    public function destroy(Request $request)
    {
        Session::flush();

        return redirect()->route('central-logout');
    }

    public function centralLogout(Request $request)
    {
        if (auth()->user()) {
            $this->destroy($request);
        }

        return redirect()->back();
    }

    protected function authenticate(string $email, string $password): User|null
    {
        Auth::attempt([
            'email' => $email,
            'password' => $password,
        ]);

        return auth()->user();
    }

    public function redirectUserToTenant(User|string|int $user, Tenant|string|int $tenant)
    {
        if (! $tenant instanceof Tenant) {
            $tenant = Tenant::find($tenant);

            if (is_null($tenant)) {
                throw new Exception('Tenant with the key passed in the "tenant" parameter does not exist');
            }
        }

        // If $user is not an instance of User, assume $user is the global user ID
        $globalUserId = $user instanceof User ? $user->global_id : $user;
        $tenantUser = $tenant->run(fn() => User::firstWhere('global_id', $globalUserId));

        return redirect($tenant->impersonationUrl($tenantUser->id));
    }

    /**
     * Redirect user to tenant's primary domain,
     * or if the user has access to many tenants,
     * render the login page where the user can choose to which tenant he wants to get redirected to.
     */
    protected function redirectUserToTenantOrShowTenantSelector(User $user)
    {
        // If the request has a tenant, redirect user to that tenant
        $tenant = request()->get('tenant') ? tenancy()->find(request()->get('tenant')) : null;

        if (is_null($tenant)) {
            $availableTenants = CentralUser::firstWhere('global_id', $user->global_id)->tenants;

            // If there are multiple available tenants, let user select the tenant
            if ($availableTenants->count() > 1) {
                return view('login', ['tenants' => $availableTenants]);
            }

            $tenant = $availableTenants->first();
        }

        return $this->redirectUserToTenant($user->global_id, $tenant);
    }
}
