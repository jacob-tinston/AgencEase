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
        @include('central.partials._header')
    
        @yield('body')
    
        <!-- Scripts -->
        <script src="{{ asset('/build/js/vendor.js') }}"></script>

        @yield('scripts')

        <script src="{{ asset('/build/js/script.js') }}"></script>
    </body>
</html>
