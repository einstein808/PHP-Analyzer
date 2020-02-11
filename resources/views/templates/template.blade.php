<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="{{ asset('js/app.js') }}"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
        {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script> --}}
        {{-- <style>
            .wrapper {
            position: relative;
            top: 0;
            height: 100vh; }
            .sidebar .nav a,
            .table > tbody > tr .td-actions .btn {
            -webkit-transition: all 150ms ease-in;
            -moz-transition: all 150ms ease-in;
            -o-transition: all 150ms ease-in;
            -ms-transition: all 150ms ease-in;
            transition: all 150ms ease-in; }

            .sidebar {
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                z-index: 1;
                background-size: cover;
                background-position: center center; }
            .sidebar .sidebar-wrapper {
                position: relative;
                max-height: none;
                min-height: 100%;
                overflow: hidden;
                width: 260px;
                z-index: 4;
                box-shadow: inset -1px 0px 0px 0px #DDDDDD; }
            .sidebar .sidebar-background {
                position: absolute;
                z-index: 1;
                height: 100%;
                width: 100%;
                display: block;
                top: 0;
                left: 0;
                background-size: cover;
                background-position: center center; }

                .sidebar,
                .off-canvas-sidebar {
                width: 260px;
                display: block;
                font-weight: 200; }
                .sidebar .logo,
                .off-canvas-sidebar .logo {
                    padding: 18px 0px;
                    margin: 0 20px; }
                    .sidebar .logo p,
                    .off-canvas-sidebar .logo p {
                    float: left;
                    font-size: 20px;
                    margin: 10px 10px;
                    line-height: 20px; }
                    .sidebar .logo .simple-text,
                    .off-canvas-sidebar .logo .simple-text {
                    text-transform: uppercase;
                    padding: 4px 0px;
                    display: block;
                    font-size: 18px;
                    text-align: center;
                    font-weight: 400;
                    line-height: 30px; }
                .sidebar .nav,
                .off-canvas-sidebar .nav {
                    margin-top: 20px; }
                    .sidebar .nav li > a,
                    .off-canvas-sidebar .nav li > a {
                    margin: 10px 0px;
                    padding-left: 25px;
                    padding-right: 25px;
                    opacity: .7; }
                    .sidebar .nav li:hover > a,
                    .off-canvas-sidebar .nav li:hover > a {
                    opacity: 1; }
                    .sidebar .nav li.active > a,
                    .off-canvas-sidebar .nav li.active > a {
                    color: #7A9E9F;
                    opacity: 1; }
                    .sidebar .nav li.active > a:before,
                    .off-canvas-sidebar .nav li.active > a:before {
                        border-right: 17px solid #DDDDDD;
                        border-top: 17px solid transparent;
                        border-bottom: 17px solid transparent;
                        content: "";
                        display: inline-block;
                        position: absolute;
                        right: 0;
                        top: 8px; }
                    .sidebar .nav li.active > a:after,
                    .off-canvas-sidebar .nav li.active > a:after {
                        border-right: 17px solid #f4f3ef;
                        border-top: 17px solid transparent;
                        border-bottom: 17px solid transparent;
                        content: "";
                        display: inline-block;
                        position: absolute;
                        right: -1px;
                        top: 8px; }
                    .sidebar .nav p,
                    .off-canvas-sidebar .nav p {
                    margin: 0;
                    line-height: 30px;
                    font-size: 12px;
                    font-weight: 600;
                    text-transform: uppercase; }
                    .sidebar .nav i,
                    .off-canvas-sidebar .nav i {
                    font-size: 24px;
                    float: left;
                    margin-right: 15px;
                    line-height: 30px;
                    width: 30px;
                    text-align: center; }
                .sidebar:after, .sidebar:before,
                .off-canvas-sidebar:after,
                .off-canvas-sidebar:before {
                    display: block;
                    content: "";
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    top: 0;
                    left: 0;
                    z-index: 2;
                    background: #FFFFFF; }
                .sidebar:after, .sidebar:before, .sidebar[data-background-color="white"]:after, .sidebar[data-background-color="white"]:before,
                .off-canvas-sidebar:after,
                .off-canvas-sidebar:before,
                .off-canvas-sidebar[data-background-color="white"]:after,
                .off-canvas-sidebar[data-background-color="white"]:before {
                    background-color: #FFFFFF; }
                .sidebar .logo, .sidebar[data-background-color="white"] .logo,
                .off-canvas-sidebar .logo,
                .off-canvas-sidebar[data-background-color="white"] .logo {
                    border-bottom: 1px solid rgba(102, 97, 91, 0.3); }
                    .sidebar .logo p, .sidebar[data-background-color="white"] .logo p,
                    .off-canvas-sidebar .logo p,
                    .off-canvas-sidebar[data-background-color="white"] .logo p {
                    color: #ffffff; }
                    .sidebar .logo .simple-text, .sidebar[data-background-color="white"] .logo .simple-text,
                    .off-canvas-sidebar .logo .simple-text,
                    .off-canvas-sidebar[data-background-color="white"] .logo .simple-text {
                    color: #ffffff; }
                .sidebar .nav li:not(.active) > a, .sidebar[data-background-color="white"] .nav li:not(.active) > a,
                .off-canvas-sidebar .nav li:not(.active) > a,
                .off-canvas-sidebar[data-background-color="white"] .nav li:not(.active) > a {
                    color: #ffffff; }
                .sidebar .nav .divider, .sidebar[data-background-color="white"] .nav .divider,
                .off-canvas-sidebar .nav .divider,
                .off-canvas-sidebar[data-background-color="white"] .nav .divider {
                    background-color: rgba(102, 97, 91, 0.2); }
                .sidebar[data-background-color="black"]:after, .sidebar[data-background-color="black"]:before,
                .off-canvas-sidebar[data-background-color="black"]:after,
                .off-canvas-sidebar[data-background-color="black"]:before {
                    background-color: #212120; }
                .sidebar[data-background-color="black"] .logo,
                .off-canvas-sidebar[data-background-color="black"] .logo {
                    border-bottom: 1px solid rgba(255, 255, 255, 0.3); }
                    .sidebar[data-background-color="black"] .logo p,
                    .off-canvas-sidebar[data-background-color="black"] .logo p {
                    color: #FFFFFF; }
                    .sidebar[data-background-color="black"] .logo .simple-text,
                    .off-canvas-sidebar[data-background-color="black"] .logo .simple-text {
                    color: #FFFFFF; }
                .sidebar[data-background-color="black"] .nav li:not(.active) > a,
                .off-canvas-sidebar[data-background-color="black"] .nav li:not(.active) > a {
                    color: #FFFFFF; }
                .sidebar[data-background-color="black"] .nav .divider,
                .off-canvas-sidebar[data-background-color="black"] .nav .divider {
                    background-color: rgba(255, 255, 255, 0.2); }
                .sidebar[data-active-color="primary"] .nav li.active > a,
                .off-canvas-sidebar[data-active-color="primary"] .nav li.active > a {
                    color: #7A9E9F;
                    opacity: 1; }
                .sidebar[data-active-color="info"] .nav li.active > a,
                .off-canvas-sidebar[data-active-color="info"] .nav li.active > a {
                    color: #68B3C8;
                    opacity: 1; }
                .sidebar[data-active-color="success"] .nav li.active > a,
                .off-canvas-sidebar[data-active-color="success"] .nav li.active > a {
                    color: #7AC29A;
                    opacity: 1; }
                .sidebar[data-active-color="warning"] .nav li.active > a,
                .off-canvas-sidebar[data-active-color="warning"] .nav li.active > a {
                    color: #F3BB45;
                    opacity: 1; }
                .sidebar[data-active-color="danger"] .nav li.active > a,
                .off-canvas-sidebar[data-active-color="danger"] .nav li.active > a {
                    color: #EB5E28;
                    opacity: 1; }

        
        </style> --}}
        <title>SegWeb</title>
    </head>
    <body>
        {{-- @if (empty($analisis)) --}}
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="/">SegWeb</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Alterna navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Enviar arquivo <i class="fa fa-file" aria-hidden="true"></i><span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/github">Enviar repositório do Github <i class="fa fa-github" aria-hidden="true"></i><span class="sr-only"></span></a>
                        </li>
                        @if (Auth::check())    
                            <li>
                                <a class="nav-link" href="/yourfiles">Seus arquivos <i class="fa fa-files-o" aria-hidden="true"></i></i><span class="sr-only"></span></a>
                            </li>
                        @endif
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        </ul>
                </div>
            </nav>
        {{-- @endif --}}
        {{-- @if (!empty($analisis))
            <div class="wrapper">
                <div class="sidebar">
                <div class="sidebar-wrapper" style="background-color: #343a40 !important;">
                    <div class="col-md-12">
                        <ul>
                            <li>
                                <a href="">asdasd</a>
                            </li>
                            <li>
                                    <a href="">asdasd</a>
                                </li>
                        </ul>
                    </div>
                    @yield('analisis')
                </div>
            </div>
        @endif --}}
        <div class="container-fluid mt-2">
            @yield('content')
        </div>
    </body>
    <footer class="mt-2">
        <script src="{{ asset('js/jquery-input-file.js') }}"></script>
        <script type="text/javascript">
            j = jQuery.noConflict()

            j.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': j('meta[name="csrf-token"]').attr('content')
                }
            });

            j(document).ready(function() {
                if(j(":file").length) {
                    j(":file").filestyle({placeholder: "Selecione os arquivos"})
                }
                
                // if(j('.addDataTable').length) {
                //     j(this).DataTable()
                // }

                j('#btn_scroll').click(function() {
                    window.scrollTo({top:0, behavior: 'smooth'})
                })
            })

            function ajaxLoadResult(file) {
                j.ajax({
                    url: "{{ url('/ajax_result') }}",
                    type: 'POST',
                    cache: false,
                    data: { 
                        file: file
                    },
                    // datatype: 'html',
                    success: function(success) {
                        console.log(success)
                    },
                    error: function(a, b, c) {
                        console.log(a)
                        console.log(b)
                        console.log(c)
                    }
                })
            }
        </script>
        @if (!empty($msg))
            <p>{{$msg}}</p>
        @endif
    </footer>
</html>
