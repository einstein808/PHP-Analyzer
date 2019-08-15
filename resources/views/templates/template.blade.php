<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SegWeb</title>
    </head>
    <body>
        <div class="container-fluid">
            @yield('content')
        </div>
    </body>
    <footer>
        <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('js/jquery-input-file.js') }}"></script>
        <script type="text/javascript">
            j = jQuery.noConflict();
            j(document).ready(function() {
                if(j(":file").length) {
                    j(":file").filestyle({placeholder: "Nenhum arquivo foi selecionado!"});
                }
            })
        </script>
    </footer>
</html>
