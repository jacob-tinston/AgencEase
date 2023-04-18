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
            <main class="workspace">
                @yield('workspace')

                @if(!isset($footer) or $footer)
                    @include('tenant.partials._footer')
                @endif
            </main>
        </div>

        <!-- Scripts -->
        @vite(['resources/js/app.js'])
        @vite(['resources/js/features/customizer.js'])

        @yield('scripts')
    </body>
</html>
