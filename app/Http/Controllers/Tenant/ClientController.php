<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Client;
use App\Models\Tenant\Contact;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request, $search_term = '')
    {
        $order_by_col = $request->sort ? 'name' : 'created_at';
        $order_by = $request->sort ?? 'desc';
        $clients = Client::where('name', 'LIKE', "%$search_term%")
                        ->orderBy($order_by_col, $order_by)
                        ->paginate(auth()->user()->per_page);

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
        $contacts = Contact::whereNotIn('id', $client->contacts->pluck('id'))->get();

        return view('tenant.clients.edit')->with([
            'client' => $client,
            'contacts' => $contacts,
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

    public function search(Request $request)
    {
        $request->validate([
            'term' => 'string'
        ]);

        if (! $term = $request->term) {
            return redirect()->back();
        }

        return $this->index($request, $term);
    }

    public function attachContacts(Request $request, $client_id)
    {
        $data = $request->validate([
            'contacts' => 'required|string',
        ]);

        $client = Client::find($client_id);

        $contactEmails = explode(',', $data['contacts']);
        $contacts = Contact::whereIn('email', $contactEmails)->pluck('id');

        $client->contacts()->attach($contacts);

        return redirect()->back()->with('success', 'Contacts Added Successfully');
    }

    public function detachContact(Request $request, $client_id, $id)
    {
        $client = Client::find($client_id);
        $contact = Contact::find($id);

        $client->contacts()->detach($contact);

        return redirect()->back()->with('success', 'Contact Removed Successfully');
    }
}
