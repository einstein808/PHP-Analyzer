@extends('templates.template')
@section('content')
    <div class="row">
        @if(!empty($file_content))
        <div class="container">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Arquivos analisados</h1>
                    </div>
                    <div class="card-title text-center">
                        <h3>{{$originalname}}</h3>
                    </div>
                    <div class="card-subtitle text-center">
                        <h4>Análise do arquivo: {{$originalname}}</h4>
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
        </div>
        @endif
    </div>
    <div class="row mt-2">
        <div class="container">
            <form action="/" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>
                                @if(empty($file_content))
                                    Enviar arquivos
                                @else
                                    Enviar novos arquivos
                                @endif
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <input type="file" name="file" id="file" class="form-control-file" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Enviar <i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
