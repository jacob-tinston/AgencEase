<!-- Top Bar -->
<header class="top-bar">

    <!-- Brand -->
    <span class="brand"><a href="{{ route('home' )}}">{{ config('app.name') }}</a></span>

    <nav class="flex items-center ltr:ml-auto rtl:mr-auto">

        <!-- Dark Mode -->
        <label class="switch switch_outlined" data-toggle="tooltip" data-tippy-content="Toggle Dark Mode">
            <input id="darkModeToggler" type="checkbox">
            <span></span>
        </label>

        <!-- Login -->
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn_primary uppercase ltr:ml-5 rtl:mr-5">Get Started</a>
        @endif
    </nav>
</header>
