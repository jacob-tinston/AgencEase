@extends('tenant.layouts.app', ['title' => 'Edit Contact'])

@section('workspace')
    <section class="breadcrumb">
        <h1>Edit Contact</h1>
        <ul>
            <p>Apps</p>
            <li class="divider la la-arrow-right"></li>
            <a href="{{ route('clients.index') }}">Clients</a>
            <li class="divider la la-arrow-right"></li>
            <a href="{{ route('clients.edit', ['id' => $client->id]) }}">Edit Client</a>
            <li class="divider la la-arrow-right"></li>
            <p>Edit Contact</p>
        </ul>
    </section>

    <div class="flex flex-col gap-y-8 items-center justify-center mt-5">
        <form action="{{ route('contacts.update', ['client_id' => $client->id, 'id' => $contact->id]) }}" method="POST" class="card card_row p-6 flex flex-col max-w-4xl">
            @csrf

            <h2 class="mb-6">Edit {{ $contact->name ?? $contact->email }}</h2>
            
            <div class="xl:p-4">
                <div class="w-full">
                    <div class=" md:flex gap-6">
                        <div class="mb-5 md:w-1/2">
                            <label class="label block mb-2" for="name">Name</label>
                            <input id="name" name="name" type="text" class="form-control @error('name')is-invalid @enderror" value="{{ $contact->name }}">
                            @error('name')
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-5 md:w-1/2">
                            <label class="label block mb-2" for="email">Email</label>
                            <input id="email" name="email" type="email" class="form-control @error('email')is-invalid @enderror" value="{{ $contact->email }}">
                            @error('email')
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class=" md:flex gap-6">
                        <div class="mb-5 md:w-1/2">
                            <label class="label block mb-2" for="phone">Phone</label>
                            <input id="phone" name="phone" type="tel" class="form-control @error('phone')is-invalid @enderror" value="{{ $contact->phone }}">
                            @error('phone')
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-5 md:w-1/2">
                            <label class="label block mb-2" for="role">Role</label>
                            <input id="role" name="role" type="text" class="form-control @error('role')is-invalid @enderror" value="{{ $contact->pivot->role }}">
                            @error('role')
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-6">

            <div class="flex items-center justify-end pr-2 mb-5 gap-4">
                <a class="text-normal" href="{{ route('clients.edit', ['id' => $client->id]) }}">Cancel</a>
                <button class="btn btn_primary uppercase">Update Contact</button>
            </div>
        </form>
    </div>
@endsection
