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
            <form class="flex flex-auto">
                <label class="form-control-addon-within rounded-full">
                    <input class="form-control border-none" placeholder="Search">
                    <button class="text-gray-300 dark:text-gray-700 text-xl leading-none la la-search ltr:mr-4 rtl:ml-4"></button>
                </label>
            </form>

            <div class="flex gap-x-2">
                <div class="dropdown">
                    <button class="btn btn_outlined btn_secondary uppercase" data-toggle="dropdown-menu" aria-expanded="false">
                        Sort By
                        <span class="ltr:ml-3 rtl:mr-3 la la-caret-down text-xl leading-none"></span>
                    </button>
                    <div class="dropdown-menu">
                        <a href="#no-link">Ascending</a>
                        <a href="#no-link">Descending</a>
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
                <div class="body">
                    @if($client->description)
                        <p>{{ \Illuminate\Support\Str::limit($client->description, 100, $end='...') }}</p>
                    @endif
                    <h6 class="uppercase mt-4">Date Created</h6>
                    <p>{{ $client->created_at->toFormattedDateString() }}</p>
                </div>
                <div class="actions">
                    <a href="#no-link" class="btn btn-icon btn_outlined btn_secondary">
                        <span class="la la-pen-fancy"></span>
                    </a>
                    <a href="#no-link" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2">
                        <span class="la la-trash-alt"></span>
                    </a>
                    <div class="dropdown ltr:ml-auto rtl:mr-auto ltr:-mr-3 rtl:-ml-3">
                        <button data-toggle="dropdown-menu" aria-expanded="false">
                            <span class="la la-ellipsis-v text-4xl leading-none"></span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="#no-link">Dropdown Action</a>
                            <a href="#no-link">Link</a>
                            <hr>
                            <a href="#no-link">Something Else</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-5">
        <!-- Pagination -->
        <div class="card lg:flex">
            <nav class="flex flex-wrap gap-2 p-5">
                <a href="#no-link" class="btn btn_primary">First</a>
                <a href="#no-link" class="btn btn_primary">1</a>
                <a href="#no-link" class="btn btn_outlined btn_secondary">2</a>
                <a href="#no-link" class="btn btn_outlined btn_secondary">3</a>
                <a href="#no-link" class="btn btn_outlined btn_secondary">4</a>
                <a href="#no-link" class="btn btn_outlined btn_secondary">5</a>
                <a href="#no-link" class="btn btn_secondary">Last</a>
            </nav>
            <div class="flex items-center ltr:ml-auto rtl:mr-auto p-5 border-t lg:border-t-0 border-divider">
                Displaying 1-5 of 100 items
            </div>
            <div class="flex items-center gap-2 p-5 border-t lg:border-t-0 lg:ltr:border-l lg:rtl:border-r border-divider">
                <span>Show</span>
                <div class="dropdown">
                    <button class="btn btn_outlined btn_secondary" data-toggle="dropdown-menu" aria-expanded="false">
                        5
                        <span class="ltr:ml-3 rtl:mr-3 la la-caret-down text-xl leading-none"></span>
                    </button>
                    <div class="dropdown-menu">
                        <a href="#no-link">5</a>
                        <a href="#no-link">10</a>
                        <a href="#no-link">15</a>
                    </div>
                </div>
                <span>items</span>
            </div>
        </div>
    </div>
@endsection
