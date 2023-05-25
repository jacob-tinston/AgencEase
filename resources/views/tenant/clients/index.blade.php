@extends('tenant.layouts.app', ['title' => 'Clients'])

@section('workspace')
    <section class="breadcrumb lg:flex items-start">
        <div>
            <h1>Manage Clients</h1>
            <ul>
                <p>Apps</p>
                <li class="divider la la-arrow-right"></li>
                <li>Clients</li>
            </ul>
        </div>

        <div class="flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 lg:mt-0">
            <form action="{{ route('clients.search') }}" method="GET" class="flex flex-auto">
                <label class="form-control-addon-within rounded-full">
                    <input name="term" class="form-control border-none" placeholder="Search">
                    <button type="submit" class="text-gray-300 dark:text-gray-700 text-xl leading-none la la-search ltr:mr-4 rtl:ml-4"></button>
                </label>
            </form>

            <div class="flex gap-x-2">
                <div class="dropdown">
                    <button class="btn btn_outlined btn_secondary uppercase" data-toggle="dropdown-menu" aria-expanded="false">
                        Sort By
                        <span class="ltr:ml-3 rtl:mr-3 la la-caret-down text-xl leading-none"></span>
                    </button>
                    <div class="dropdown-menu">
                        <a href="?{{ request()->term ? 'term='.request()->term.'&' : '' }}sort=asc">Ascending</a>
                        <a href="?{{ request()->term ? 'term='.request()->term.'&' : '' }}sort=desc">Descending</a>
                    </div>
                </div>

                <a href="{{ route('clients.create') }}" class="btn btn_primary uppercase">Add New</a>
            </div>
        </div>
    </section>

    <div class="grid lg:grid-cols-3 gap-5 mt-5">
        @foreach($clients as $client)
            <div class="card card_column">
                <div class="flex items-center justify-between p-5">
                    <label class="custom-checkbox">
                        <input type="checkbox" data-toggle="cardSelection">
                        <span></span>
                    </label>

                    <div class="badge badge_outlined badge_secondary uppercase">
                        {{ $client->type }}
                    </div>
                </div>

                <div class="header flex items-center gap-4">
                    <span class="avatar">
                        {{ initials($client->name) }}
                    </span>
                    <h5 class="h-fit">{{ $client->name }}</h5>
                </div>
                <div class="body h-full flex-col justify-end">
                    @if($client->description)
                        <p>{{ \Illuminate\Support\Str::limit($client->description, 100, $end='...') }}</p>
                    @endif
                    <h6 class="uppercase mt-4">Date Created</h6>
                    <p>{{ $client->created_at->toFormattedDateString() }}</p>
                </div>
                <div class="actions">
                    <a href="{{ route('clients.edit', ['id' => $client->id]) }}" class="btn btn-icon btn_outlined btn_secondary">
                        <span class="la la-pen-fancy"></span>
                    </a>
                    <a data-toggle="modal" data-target="client-{{ $client->id }}" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2">
                        <span class="la la-trash-alt"></span>
                    </a>
                    <div class="dropdown ltr:ml-auto rtl:mr-auto ltr:-mr-3 rtl:-ml-3">
                        <button data-toggle="dropdown-menu" aria-expanded="false">
                            <span class="la la-ellipsis-v text-4xl leading-none"></span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('clients.edit', ['id' => $client->id]) }}">Edit Client</a>
                            <hr>
                            <button class="!text-danger" data-toggle="modal" data-target="client-{{ $client->id }}">Remove Client</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal client-{{ $client->id }}" data-animations="fadeInDown, fadeOutUp">
                <div class="modal-dialog modal-dialog_centered max-w-2xl">
                    <div class="modal-content w-full">
                        <div class="modal-header">
                            <h2 class="modal-title">Remove Client</h2>
                            <button class="close la la-times" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            This action is irreversible. Are you sure you want to delete this client?
                        </div>
                        <div class="modal-footer">
                            <div class="flex ltr:ml-auto rtl:mr-auto">
                                <button class="btn btn_secondary uppercase" data-dismiss="modal">Close</button>
                                <a href="{{ route('clients.delete', ['id' => $client->id]) }}" class="btn btn_danger ltr:ml-2 rtl:mr-2 uppercase">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @include('tenant.partials._pagination', ["collection" => json_decode($clients->toJson())])
@endsection
