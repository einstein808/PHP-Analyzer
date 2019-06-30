<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>SegWeb</title>

    </head>
    <body>
        <div class="container-fluid">
            @yield('content')
        </div>
    </body>
</html>