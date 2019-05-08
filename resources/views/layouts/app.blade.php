<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    {{-- Fonts --}}
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    {{-- Style --}}
    <link href="{{ asset('admin-assets/style.css') }}" rel="stylesheet">    

    {{-- Self Style --}}
    @yield('style')
</head>
<body>
    @yield('content')

    @yield('script')
</body>
</html>
