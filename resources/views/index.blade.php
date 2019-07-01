@extends('templates.template')
@section('content')
    <style>
        .pastel-red {
            background-color: #FFA07A;
        }

        .pure-red {
            background-color: #FF6347;
        }

        .pastel-green {
            background-color: #98FB98;
        }

        .pure-green {
            background-color: #3CB371;
        }

        .pastel-yellow {
            background-color: #F0E68C;
        }

        .pure-yellow {
            background-color: #FEE364;
        }

        .code-border {
            border: 1px solid black;
        }

        .w100 {
            width: 100%;
        }

        .key-style {
            border-right: 1px solid lightgrey !important;
            text-align: right;
        }

        .unselectable {
            -webkit-touch-callout: none; /* iOS Safari */
            -webkit-user-select: none; /* Safari */
            -khtml-user-select: none; /* Konqueror HTML */
            -moz-user-select: none; /* Firefox */
            -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome and Opera */
        }

    </style>
    <div class="row">
        @if(!empty($file_content))
        <div class="col-md-12">
            <div class="card">
                <div class="card-title text-center">
                    <strong>{{$originalname}}</strong>
                </div>
                <div class="card-body">
                    <pre>
                        <code style="color: black !important;">
                            <table class="code-border w100">
                                <tbody>
                                    @foreach ($file_content as $key => $file)
                                    @php
                                    {{
                                        $key_color = 'pure-green';
                                        $line_color = 'pastel-green';
                                        if(!empty($file['warning'])) {
                                            $key_color = 'pure-yellow';
                                            $line_color = 'pastel-yellow';
                                        }
                                        if(!empty($file['danger'])) {
                                            $key_color = 'pure-red';
                                            $line_color = 'pastel-red';
                                        }
                                    }}    
                                    @endphp
                                    <tr>
                                        <td class="{{$key_color}} key-style unselectable">{{(1+$key). " - "}}</td>
                                        <td class="{{$line_color}}">{{$file['text']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </code>
                    </pre>
                </div>
                <div class="card-footer">
                    <strong>RESULTADOS</strong>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div>
        <form action="/" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" id="file">
            <button type="submit">Enviar</button>
        </form>
    </div>
@endsection
