<!-- Top Bar -->
<header class="top-bar">

    <!-- Menu Toggler -->
    <button class="menu-toggler la la-bars" data-toggle="menu"></button>

    <!-- Brand -->
    @include('partials._logo')

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
            <input id="darkModeToggler" type="checkbox">
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
                    <a href="#no-link" class="p-5 text-normal hover:text-primary">
                        <span class="block la la-users text-5xl leading-none"></span>
                        <span>Users</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <div class="dropdown self-stretch">
            <button class="relative flex items-center h-full ltr:ml-1 rtl:mr-1 px-2 text-2xl leading-none la la-bell"
                data-toggle="custom-dropdown-menu" data-tippy-arrow="true" data-tippy-placement="bottom-end">
                <span
                    class="absolute top-0 right-0 rounded-full border border-primary -mt-1 -mr-1 px-2 leading-tight text-xs font-body text-primary">3</span>
            </button>
            <div class="custom-dropdown-menu">
                <div class="flex items-center px-5 py-2">
                    <h5 class="mb-0 uppercase mr-6">Notifications</h5>
                    <button class="btn btn_outlined btn_warning uppercase ltr:ml-auto rtl:mr-auto">Clear All</button>
                </div>
                <hr>
                <div class="p-5">
                    <p>No notifications.</p>
                </div>
            </div>
        </div>

        <!-- User Menu -->
        <div class="dropdown">
            <button class="flex items-center ltr:ml-4 rtl:mr-4" data-toggle="custom-dropdown-menu"
                data-tippy-arrow="true" data-tippy-placement="bottom-end">
                <span class="avatar">{{ auth()->user()->initials }}</span>
            </button>
            <div class="custom-dropdown-menu w-64">
                <div class="p-5">
                    <h5 class="uppercase">{{ auth()->user()->name }}</h5>
                    <p>Admin</p>
                </div>
                <hr>
                <div class="p-5">
                    <a href="#no-link" class="flex items-center text-normal hover:text-primary">
                        <span class="la la-user-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                        View Profile
                    </a>
                    <a href="#no-link" class="flex items-center text-normal hover:text-primary mt-5">
                        <span class="la la-key text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                        Change Password
                    </a>
                </div>
                <hr>
                <div class="p-5">
                    <a href="{{ route('logout') }}" class="flex items-center text-normal hover:text-primary">
                        <span class="la la-power-off text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Menu Bar -->
<aside class="menu-bar menu-sticky menu-wide">
    <div class="menu-items">
        <div class="menu-header hidden">
            <a href="{{ url('/') }}" class="flex items-center mx-8 mt-8">
                <span class="avatar w-16 h-16">{{ tenant('initials') }}</span>
                <div class="ltr:ml-4 rtl:mr-4 ltr:text-left rtl:text-right">
                    <h5>{{ tenant('organization') }}</h5>
                </div>
            </a>
            <hr class="mx-8 my-4">
        </div>
        <a href="{{ url('/') }}" class="link" data-toggle="tooltip-menu" data-tippy-content="Dashboard">
            <span class="icon la la-laptop"></span>
            <span class="title">Dashboard</span>
        </a>
    </div>
</aside>

@if (auth()->user())
    @include('tenant.partials._customizer')
@endif
