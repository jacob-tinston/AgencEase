@extends('tenant.layouts.app', ['title' => 'Create Client'])

@section('workspace')
    <section class="breadcrumb">
        <h1>Create Client</h1>
        <ul>
            <p>Apps</p>
            <li class="divider la la-arrow-right"></li>
            <a href="{{ route('clients.index') }}">Clients</a>
            <li class="divider la la-arrow-right"></li>
            <li>Create Client</li>
        </ul>
    </section>

    <div class="flex flex-col gap-y-8 items-center justify-center mt-5">
        <form action="{{ route('clients.store') }}" method="POST" class="card card_row p-6 flex flex-col max-w-4xl">
            @csrf

            <h2 class="mb-6">Create a New Client</h2>
            
            <div class="xl:p-4">
                <div class="w-full">
                    <div class=" md:flex gap-6">
                        <div class="mb-5 md:w-1/2">
                            <label class="label block mb-2" for="name">Name</label>
                            <input id="name" name="name" type="text" class="form-control @error('name')is-invalid @enderror">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-5 md:w-1/2">
                            <label class="label block mb-2" for="type">Client Type</label>
                            <div class="flex gap-6 mt-4">
                                <label class="custom-radio">
                                    <input type="radio" name="type" value="Internal">
                                    <span></span>
                                    <span>Internal</span>
                                </label>
                                <label class="custom-radio">
                                    <input type="radio" name="type" value="External" checked>
                                    <span></span>
                                    <span>External</span>
                                </label>
                            </div>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="label block mb-2" for="description">Description</label>
                        <textarea id="description" name="description" class="form-control @error('description')is-invalid @enderror" rows="5" style="height: 150px;"></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="my-6">

            <div class="flex justify-end pr-2 mb-5">
                <button class="btn btn_primary uppercase">Create Client</button>
            </div>
        </form>
    </div>
@endsection
