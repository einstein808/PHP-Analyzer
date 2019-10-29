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
                        <h4>{{$file->nome_original}}</h4>
                    </div>
                    <div class="card-body">
                        <pre>
                            <code style="color: black !important;">
                                <table class="code-border w100">
                                    <tbody>
                                        {{$result = NULL}}
                                        @foreach ($file_content as $key => $content)
                                        @php
                                            $color = 'green';
                                            foreach ($content as $term_type => $term) {
                                                if($term_type == 'disabled_functions') {
                                                    $color = 'red';
                                                    $result[] = [
                                                        'line' => 1+$key,
                                                        'error_type' => $term_type,
                                                        'error' => "Uso de $term"
                                                    ];
                                                } 
                                                else if($term_type == 'program_execution_functions') {
                                                    if($color != 'red') {
                                                        $color = 'yellow';
                                                        $result[] = [
                                                            'line' => 1+$key,
                                                            'error_type' => $term_type,
                                                            'error' => "Uso de ".$term
                                                        ];
                                                    }
                                                }   
                                            }
                                        @endphp
                                        <tr class="unselectable" id="line-{{1+$key}}">
                                            <td class="pure-{{$color}} key-style">{{(1+$key). " - "}}</td>
                                            <td class="pastel-{{$color}}">{{$content['text']}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </code>
                        </pre>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h1>Resultados</h1>
                    </div>
                    <div class="card-body">
                        @if(!empty($result)) 
                            <div class="list-group-flush">
                                @foreach ($result as $value)
                                    <div class="list-group-item list-group-item-action line_result" id="line_result-{{$value['line']}}">
                                        <div class="w-100">
                                            <h5 class="mb-1">Linha: {{$value['line']}}</h5>
                                            <br>
                                            <p><span class="mb-1">Tipo do erro: </span><a href="">{{$value['error_type']}}</a></p>
                                            <p class="mb-1">Erro: <span>{{$value['error']}}</span></p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <button type="button" id="btn_scroll" class="btn btn-default">
            <i class="fa fa-chevron-up" aria-hidden="true"></i>
        </button>
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
                                <button type="submit" class="btn btn-primary pull-right">Enviar <i class="fa fa-upload" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection