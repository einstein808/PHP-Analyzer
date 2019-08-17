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
                        <h4>{{$originalname}}</h4>
                    </div>
                    <div class="card-body">
                        <pre>
                            <code style="color: black !important;">
                                {{-- {{print_r($file_content)}} --}}
                                <table class="code-border w100">
                                    <tbody>
                                        @foreach ($file_content as $key => $content)
                                        @php
                                        {{
                                            $key_color = 'pure-green';
                                            $line_color = 'pastel-green';
                                            // verificar ocorrencia de mais de um termo na mesma linha (manter a cor de maior problema)
                                            foreach ($content as $term_type => $term) {
                                                if($term_type == 'disabled_functions') {
                                                    $key_color = 'pure-red';
                                                    $line_color = 'pastel-red';
                                                } 
                                                else if($term_type == 'program_execution_functions') {
                                                    if($key_color != 'pure-red') {
                                                        $key_color = 'pure-yellow';
                                                        $line_color = 'pastel-yellow';
                                                    }
                                                }
                                            }

                                            // if(!empty($content['warning'])) {
                                            //     $key_color = 'pure-yellow';
                                            //     $line_color = 'pastel-yellow';
                                            // }
                                            // if(!empty($content['danger'])) {
                                            //     $key_color = 'pure-red';
                                            //     $line_color = 'pastel-red';
                                            // }
                                        }}
                                        @endphp
                                        <tr class="unselectable">
                                            <td class="{{$key_color}} key-style">{{(1+$key). " - "}}</td>
                                            <td class="{{$line_color}}">{{$content['text']}}</td>
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
                                <button type="submit" class="btn btn-primary pull-right">Enviar <i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
