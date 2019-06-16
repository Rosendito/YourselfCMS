<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>

    {{-- Fonts --}}

    <link href="https://fonts.googleapis.com/css?family=Heebo:400,500&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/demo-1.css') }}" rel="stylesheet">

    <!-- Custom Styles -->
    @yield('styles')
</head>
<body>
    <!-- Page Content -->
    @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('js/demo-1.js') }}"></script>

    <!-- Custom Scripts -->
    @yield('scripts')
</body>
</html>
