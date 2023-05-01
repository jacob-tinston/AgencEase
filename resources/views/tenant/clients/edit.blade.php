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
            
            <div class="xl:p-4">
                <div class="w-full">
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
            </div>

            <hr class="my-6">

            <div class="flex items-center justify-end pr-2 mb-5 gap-4">
                <a class="text-normal" href="{{ route('clients.index') }}">Cancel</a>
                <button class="btn btn_primary uppercase">Update Client</button>
            </div>
        </form>
    </div>
@endsection
