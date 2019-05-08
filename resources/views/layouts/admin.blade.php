<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">  

    {{-- Material Design Fonts --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/materialdesign-icons.css') }}">

    {{-- Admin Style --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/style.css') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <div id="app">
        
    </div>
    
    <script type="text/javascript">
       
        const SERVER_DATA = @json($data)

    </script>
    <script type="text/javascript" src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/app.js') }}"></script>
</body>
</html>
