@extends('templates.template')
@section('content')
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
                                    <tr class="unselectable">
                                        <td class="{{$key_color}} key-style">{{(1+$key). " - "}}</td>
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
            <input type="file" name="file" id="file" class="form-control-file">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
@endsection
