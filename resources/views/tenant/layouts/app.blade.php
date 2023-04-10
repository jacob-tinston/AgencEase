<!DOCTYPE html>

<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        @if ($title)
            <title>{{ $title }} - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        @vite(['resources/css/app.css'])
    </head>

    <body>
        <div id="app">
            @include('tenant.partials._header')

            <!-- Workspace -->
            <main class="workspace @hasSection('sidebar') workspace_with-sidebar @endif {{ $workspaceClasses ?? '' }}">
                @yield('workspace')

                @if(!isset($footer) or $footer)
                    @include('tenant.partials._footer')
                @endif
            </main>

            @hasSection('sidebar')

                <!-- Sidebar -->
                <aside class="sidebar">

                    <!-- Toggler - Mobile -->
                    <button class="sidebar-toggler la la-ellipsis-v" data-toggle="sidebar"></button>

                    @yield('sidebar')

                </aside>

            @endif
        </div>

        <!-- Scripts -->
        @vite(['resources/js/app.js'])

        @yield('scripts')
    </body>
</html>
