<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CRMController extends Controller
{
    public function show(Request $request)
    {
        $clients = User::all();

        return view('tenant.clients.manage-clients')->with([
            'clients' => $clients,
        ]);
    }
}
