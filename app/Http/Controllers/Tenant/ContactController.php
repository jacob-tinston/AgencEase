<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Client;
use App\Models\Tenant\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ContactController extends Controller
{
    public function store(Request $request, $client_id)
    {
        $data = $request->validate([
            'name' => 'string|max:255|nullable',
            'email' => 'required|string|email|max:255|unique:contacts',
            'phone' => 'string|max:255|nullable',
            'role' => 'string|max:255|nullable',
        ]);
        
        $client = Client::find($client_id);

        $contact = Contact::create(
            Arr::only($data, ['name', 'email', 'phone'])
        );

        $client->contacts()->attach($contact->id, [
            'role' => $data['role']
        ]);

        return redirect()->back()->with('success', 'Contact Created Successfully');
    }

    public function edit(Request $request, $client_id, $id)
    {
        $client = Client::find($client_id);
        $contact = $client->contacts()->find($id);

        return view('tenant.clients.contacts.edit')->with([
            'client' => $client,
            'contact' => $contact,
        ]);
    }

    public function update(Request $request, $client_id, $id)
    {
        $data = $request->validate([
            'name' => 'string|max:255|nullable',
            'email' => 'required|string|email|max:255',
            'phone' => 'string|max:255|nullable',
            'role' => 'string|max:255|nullable',
        ]);
        
        $client = Client::find($client_id);

        $contact = $client->contacts()->find($id);

        if ($request->email !== $contact->email) {
            $request->validate([
                'email' => 'unique:contacts',
            ]);
        }

        $contact->update(
            Arr::only($data, ['name', 'email', 'phone'])
        );

        $contact = $client->contacts()->updateExistingPivot($id, [
            'role' => $data['role']
        ]);

        return redirect()->route('clients.edit', ['id' => $client_id])->with('success', 'Contact Updated Successfully');
    }
}
