<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class CRMController extends Controller
{
    public function show(Request $request)
    {
        $clients = Client::all();

        return view('tenant.clients.manage-clients')->with([
            'clients' => $clients,
        ]);
    }

    public function create(Request $request)
    {
        return view('tenant.clients.create-client');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:clients',
            'description' => 'string',
            'type' => 'required|string',
        ]);

        // dump($data['type']);

        Client::create($data);

        return redirect()->route('clients.manage')->with('success', 'Client Created Successfully');
    }
}
