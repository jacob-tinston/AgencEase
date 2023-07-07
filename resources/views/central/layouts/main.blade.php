<!DOCTYPE html>

<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        
        @if (isset($title))
            <title>{{ $title }} - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        @vite(['resources/css/app.css'])
    </head>

    <body>
        <div id="app">
            @include('central.partials._header')
    
            @yield('body')

            @include('central.partials._footer')
        </div>
    
        <!-- Scripts -->
        @vite(['resources/js/app.js'])

        @yield('scripts')
    </body>
</html>
