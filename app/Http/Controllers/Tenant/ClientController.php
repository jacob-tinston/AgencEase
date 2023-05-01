<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::all();

        return view('tenant.clients.index')->with([
            'clients' => $clients,
        ]);
    }

    public function create(Request $request)
    {
        return view('tenant.clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:clients',
            'description' => 'string|nullable',
            'type' => 'required|string',
        ]);

        Client::create($data);

        return redirect()->route('clients.index')->with('success', 'Client Created Successfully');
    }

    public function edit($id)
    {
        $client = Client::find($id);

        return view('tenant.clients.edit')->with([
            'client' => $client,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'type' => 'string',
        ]);

        $client = Client::find($id);

        if ($request->name !== $client->name) {
            $request->validate([
                'email' => 'unique:clients',
            ]);
        }

        $client->update($data);

        return back()->with('success', 'Client Updated Successfully.');
    }

    public function destroy($id)
    {
        $client = Client::find($id);

        $client->delete();

        return redirect()->back()->with('success', 'Client Deleted Successfully.');
    }
}
