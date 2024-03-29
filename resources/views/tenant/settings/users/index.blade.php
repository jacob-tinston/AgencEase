@extends('tenant.layouts.app', ['title' => 'Users'])

@section('workspace')
    <section class="breadcrumb lg:flex items-start">
        <div>
            <h1>Manage Users</h1>
            <ul>
                <a href="#">Settings</a>
                <li class="divider la la-arrow-right"></li>
                <li>Users</li>
            </ul>
        </div>

        <div class="flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 lg:mt-0">
            <form action="{{ route('users.search') }}" method="GET" class="flex flex-auto">
                <label class="form-control-addon-within rounded-full">
                    <input name="term" class="form-control border-none" placeholder="Search">
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
                        <a href="?{{ request()->term ? 'term='.request()->term.'&' : '' }}sort=asc">Ascending</a>
                        <a href="?{{ request()->term ? 'term='.request()->term.'&' : '' }}sort=desc">Descending</a>
                    </div>
                </div>

                <a href="{{ route('users.invite.create') }}" class="btn btn_primary uppercase">Add New</a>
            </div>
        </div>
    </section>

    <div class="card p-5">
        <div class="overflow-x-auto">
            <table class="table table-auto table_hoverable w-full">
                <thead>
                    <tr>
                        <th class="w-px">
                            <label class="custom-checkbox">
                                <input type="checkbox" checked="" partial="">
                                <span></span>
                            </label>
                        </th>
                        <th></th>
                        <th class="ltr:text-left rtl:text-right uppercase">Full Name</th>
                        <th class="text-center uppercase">Email</th>
                        <th class="text-center uppercase">Role</th>
                        <th class="text-center uppercase">Status</th>
                        <th class="uppercase"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <label class="custom-checkbox">
                                    <input type="checkbox" data-toggle="rowSelection">
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <span class="avatar">
                                    @if($avatar = $user->avatar)
                                        <img src="{{ asset($user->avatar) }}" alt="">
                                    @else
                                        <span>{{ initials($user->name) }}</span>
                                    @endif
                                </span>
                            </td>
                            <td class="w-1/3">{{ $user->name }}</td>
                            <td class="text-center">{{ $user->email }}</td>
                            <td class="text-center">
                                @foreach ($user->roles as $role)
                                    <span>{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td class="text-center">
                                <div class="badge badge_outlined badge_success uppercase">Active</div>
                            </td>
                            <td class="ltr:text-right rtl:text-left whitespace-nowrap">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-icon btn_outlined btn_secondary">
                                        <span class="la la-pen-fancy"></span>
                                    </a>

                                    <button data-toggle="modal" data-target="user-{{ $user->id }}" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2">
                                        <span class="la la-trash-alt"></span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <div class="modal user-{{ $user->id }}" data-animations="fadeInDown, fadeOutUp">
                            <div class="modal-dialog modal-dialog_centered max-w-2xl">
                                <div class="modal-content w-full">
                                    <div class="modal-header">
                                        <h2 class="modal-title">Remove User</h2>
                                        <button class="close la la-times" data-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        This action is irreversible. Are you sure you want to delete this user?
                                    </div>
                                    <div class="modal-footer">
                                        <div class="flex ltr:ml-auto rtl:mr-auto">
                                            <button class="btn btn_secondary uppercase" data-dismiss="modal">Close</button>
                                            <a href="{{ route('users.delete', ['id' => $user->id]) }}" class="btn btn_danger ltr:ml-2 rtl:mr-2 uppercase">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('tenant.partials._pagination', ["collection" => json_decode($users->toJson())])
@endsection
