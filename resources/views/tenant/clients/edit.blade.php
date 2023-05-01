@extends('tenant.layouts.app', ['title' => 'Edit Client'])

@section('workspace')
    <section class="breadcrumb lg:flex items-start">
        <div>
            <h1>Edit Client</h1>
            <ul>
                <p>Apps</p>
                <li class="divider la la-arrow-right"></li>
                <a href="{{ route('clients.index') }}">Clients</a>
                <li class="divider la la-arrow-right"></li>
                <li>Edit Client</li>
            </ul>
        </div>
    </section>

    <div class="flex flex-col gap-y-8 items-center justify-center mt-5">
        <form action="{{ route('clients.update', ['id' => $client->id]) }}" method="POST" class="card card_row p-6 flex flex-col max-w-4xl">
            @csrf

            <h2 class="mb-6">Edit {{ $client->name }}</h2>

            <div class="tabs">
                <nav class="tab-nav">
                    <p class="nav-link h5 uppercase active" data-toggle="tab" data-target="#tab-1">Client Details</p>
                    <p class="nav-link h5 uppercase" data-toggle="tab" data-target="#tab-2">Contacts</p>
                </nav>
                <div class="tab-content mt-5">
                    <div id="tab-1" class="collapse open">
                        <div class=" md:flex gap-6">
                            <div class="mb-5 md:w-1/2">
                                <label class="label block mb-2" for="name">Name</label>
                                <input id="name" name="name" type="text" class="form-control @error('name')is-invalid @enderror" value="{{ $client->name }}">
                                @error('name')
                                    <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
    
                            <div class="mb-5 md:w-1/2">
                                <label class="label block mb-2" for="type">Client Type</label>
                                <div class="flex gap-6 mt-4">
                                    <label class="custom-radio">
                                        <input type="radio" name="type" value="Internal" @if($client->type == 'Internal')checked @endif>
                                        <span></span>
                                        <span>Internal</span>
                                    </label>
                                    <label class="custom-radio">
                                        <input type="radio" name="type" value="External" @if($client->type == 'External')checked @endif>
                                        <span></span>
                                        <span>External</span>
                                    </label>
                                </div>
                                @error('type')
                                    <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
    
                        <div class="mb-5">
                            <label class="label block mb-2" for="description">Description</label>
                            <textarea id="description" name="description" class="form-control @error('description')is-invalid @enderror" rows="5" style="height: 150px;">{{ $client->description }}</textarea>
                            @error('description')
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div id="tab-2" class="collapse">
                        <p data-toggle="modal" class="btn btn_outlined btn_primary ml-auto">Create Contact</p>

                        <div class="w-full overflow-scroll">
                            <table class="table table_hoverable w-full mt-3 overflow-scroll">
                                <thead>
                                    <tr>
                                        <th class="ltr:text-left rtl:text-right uppercase">Name</th>
                                        <th class="ltr:text-left rtl:text-right uppercase">Email</th>
                                        <th class="ltr:text-left rtl:text-right uppercase">Phone Number</th>
                                        <th class="ltr:text-left rtl:text-right uppercase">Role</th>
                                        <th class="ltr:text-left rtl:text-right uppercase">Last Contacted</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($client->contacts))
                                        @foreach($client->contacts as $contact)
                                            <tr>
                                                <td class="min-w-[150px]">@if($contact->name){{ $contact->name }}@else--@endif</td>
                                                <td class="min-w-[200px]"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
                                                <td class="min-w-[200px]">@if($contact->phone)<a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>@else--@endif</td>
                                                <td class="min-w-[200px]">@if($contact->pivot->role){{ $contact->pivot->role }}@else--@endif</td>
                                                <td class="min-w-[150px]">@if($contact->last_contacted){{ $contact->last_contacted }}@else--@endif</td>
                                                <td>
                                                    <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                                        <a class="btn btn-icon btn_outlined btn_secondary">
                                                            <span class="la la-pen-fancy"></span>
                                                        </a>
                    
                                                        <button data-toggle="modal" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2">
                                                            <span class="la la-trash-alt"></span>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="!bg-transparent">
                                            <td>No Contacts</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-6">

            <div class="flex items-center justify-end pr-2 mb-5 gap-4">
                <a class="text-normal" href="{{ route('clients.index') }}">Cancel</a>
                <button class="btn btn_primary uppercase">Update Client</button>
            </div>
        </form>
    </div>

    <div class="modal modal_aside" data-animations="fadeInRight, fadeOutRight">
        <div class="modal-dialog">
            <form action="{{ route('contacts.store', ['client_id' => $client->id]) }}" method="POST" class="modal-content">
                @csrf

                <div class="modal-header">
                    <h2 class="modal-title">Create Contact</h2>
                    <div class="close la la-times" data-dismiss="modal"></div>
                </div>

                <div class="modal-body">
                    <div class="mb-5">
                        <label class="label block mb-2" for="name">Name</label>
                        <input id="name" name="name" class="form-control @error('name')is-invalid @enderror" value="{{ old('name') }}" autofocus>
                        @error('name')
                            <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="label block mb-2" for="email">Email</label>
                        <input id="email" name="email" type="email" class="form-control @error('email')is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="label block mb-2" for="phone">Phone Number</label>
                        <input id="phone" name="phone" type="tel" class="form-control @error('name')is-invalid @enderror" value="{{ old('phone') }}">
                        @error('phone')
                            <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="label block mb-2" for="role">Role</label>
                        <input id="role" name="role" class="form-control @error('name')is-invalid @enderror" value="{{ old('role') }}">
                        @error('role')
                            <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn_secondary uppercase" data-dismiss="modal">Close</button>
                    <button class="btn btn_primary uppercase ltr:ml-2 rtl:mr-2">Create Contact</button>
                </div>
            </form>
        </div>
    </div>
@endsection
