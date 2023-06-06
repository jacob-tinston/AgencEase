<!-- Top Bar -->
<header class="top-bar">

    <!-- Menu Toggler -->
    <button class="menu-toggler la la-bars" onclick="document.querySelector('.menu-bar').classList.toggle('menu-hidden')"></button>

    <!-- Brand -->
    <div class="hidden md:block">
        @include('tenant.partials._logo')
    </div>

    <!-- Search -->
    <form class="hidden md:block ltr:ml-10 rtl:mr-10">
        <label class="form-control-addon-within rounded-full">
            <input class="form-control border-none" placeholder="Search">
            <button
                class="text-gray-300 dark:text-gray-700 text-xl leading-none la la-search ltr:mr-4 rtl:ml-4"></button>
        </label>
    </form>

    <!-- Right -->
    <div class="flex items-center ltr:ml-auto rtl:mr-auto">

        <!-- Dark Mode -->
        <label class="switch switch_outlined" data-toggle="tooltip" data-tippy-content="Toggle Dark Mode">
            <input class="dark-mode-toggler" type="checkbox">
            <span></span>
        </label>

        <!-- Fullscreen -->
        <button id="fullScreenToggler"
            class="hidden lg:inline-block ltr:ml-3 rtl:mr-3 px-2 text-2xl leading-none la la-expand-arrows-alt"
            data-toggle="tooltip" data-tippy-content="Fullscreen"></button>

        <!-- Apps -->
        <div class="dropdown self-stretch">
            <button
                class="flex items-center h-full ltr:ml-4 rtl:mr-4 lg:ltr:ml-1 lg:rtl:mr-1 px-2 text-2xl leading-none la la-box"
                data-toggle="custom-dropdown-menu" data-tippy-arrow="true" data-tippy-placement="bottom">
            </button>
            <div class="custom-dropdown-menu p-5 text-center">
                <div class="flex justify-around">
                    <a href="#no-link" class="p-5 text-normal hover:text-primary">
                        <span class="block la la-cog text-5xl leading-none"></span>
                        <span>Settings</span>
                    </a>

                    @can('manage users')
                        <a href="{{ route('users.index') }}" class="p-5 text-normal hover:text-primary">
                            <span class="block la la-users text-5xl leading-none"></span>
                            <span>Users</span>
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <notification-list :user-id="{{ auth()->user()->id }}" :initial-notifications="{{ auth()->user()->unreadNotifications }}" :clear-all-route="'{{ route('notifications.destroy') }}'"></notification-list>

        <!-- User Menu -->
        <div class="dropdown">
            <button class="flex items-center ltr:ml-4 rtl:mr-4" data-toggle="custom-dropdown-menu"
                data-tippy-arrow="true" data-tippy-placement="bottom-end">
                <span class="avatar">{{ initials(auth()->user()->name) }}</span>
            </button>
            <div class="custom-dropdown-menu w-64">
                <div class="p-5">
                    <h5 class="uppercase">{{ auth()->user()->name }}</h5>
                    <p>{{ auth()->user()->roles()->first()->name }}</p>
                </div>
                <hr>
                <div class="p-5">
                    <a href="{{ route('profile.edit') }}" class="flex items-center text-normal hover:text-primary">
                        <span class="la la-user-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                        My Profile
                    </a>
                    <a href="{{ route('profile.edit-password') }}" class="flex items-center text-normal hover:text-primary mt-5">
                        <span class="la la-key text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                        Change Password
                    </a>
                </div>
                <hr>
                <div class="p-5">
                    <a href="{{ route('auth.logout') }}" class="flex items-center text-normal hover:text-primary">
                        <span class="la la-power-off text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Menu Bar -->
<aside class="menu-bar menu-sticky menu-wide @if(tenant('customizer')){{ json_decode(tenant('customizer'))->branded_menu ? 'menu_branded' : '' }}@endif">
    <div class="menu-items">
        <div class="menu-header">
            <div class="flex items-center mx-8 mt-8">
                <span class="avatar w-16 h-16">{{ initials(tenant('organization')) }}</span>
                <div class="ltr:ml-4 rtl:mr-4 ltr:text-left rtl:text-right">
                    <h5>{{ tenant('organization') }}</h5>
                </div>
            </div>
            <hr class="mx-8 my-4">
        </div>

        <a href="{{ route('dashboard') }}" class="link">
            <span class="icon la la-laptop"></span>
            <span class="title">Dashboard</span>
        </a>

        @can('view clients')
            <a href="{{ route('tasks.index') }}" class="link">
                <span class="icon la la-check-circle"></span>
                <span class="title">Tasks</span>
            </a>
        @endcan

        @can('view clients')
            <a href="{{ route('clients.index') }}" class="link">
                <span class="icon la la-users"></span>
                <span class="title">Clients</span>
            </a>
        @endcan

        <a href="{{ route('chat.index') }}" class="link">
            <span class="icon la la-comment-dots"></span>
            <span class="title">Chat</span>
        </a>
    </div>
</aside>
