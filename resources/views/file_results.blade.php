@extends('templates.template')
@section('content')

@if(!empty($file))
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="/yourfiles" class="btn btn-outline-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar</a>
        </div>
    </div>
    <br>
    @php
        $count_results = 0;
        foreach($file_contents as $value) {
            $count_results += count($value['results']);
        }
    @endphp
    <div class="row">
        <div class="col-md-12">
            <h1>{{$file->original_file_name}}</h1>
            <h3>Foram encontrados {{$count_results}} problemas!</h3>
        </div>
    </div>
    @foreach($file_contents as $key => $value)
        @php
            $file_content = $value['content'];
            $file_results = $value['results'];
            $file_repo_file = $value['file'];
            if($file->type == 'File') {
                $file_path = $file->original_file_name;
            } else {
                $file_path = explode('/', explode($file->original_file_name, $file_repo_file->file_path)[1]);
                unset($file_path[0]);
                $file_path = $file->original_file_name.'/'.implode('/', $file_path);
            }
        @endphp
        <div class="card mt-2">
            <div class="card-header clickable" data-toggle="collapse" data-target="#collapse-{{$key}}" title="Clique aqui para ver os detalhes do arquivo">
                <h5>
                    @if (count($file_results) > 0)
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;
                    @endif
                    {{$file_path}}
                    @if (count($file_results) > 0)
                        &nbsp;<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                    @endif
                </h5>
            </div>
            <div id="collapse-{{$key}}" class="collapse swing-in-top-fwd">
                <div class="col-md-12 mt-1">
                    <pre>
                        <code style="color: black !important;">
                            <table class="code-border w100">
                                <tbody>
                                    @foreach($file_content as $line_number => $line_content)
                                    @php
                                    $color = 'green';
                                    foreach($file_results as $key => $file_result) {
                                        if($file_result->line_number == $line_number) {
                                            $color = $file_result->color;
                                        }
                                    }
                                    @endphp
                                    <tr class="unselectable" id="line-{{$line_number}}">
                                        <td class="pure-{{$color}} key-style">{{($line_number). " - "}}</td>
                                        <td class="pastel-{{$color}}">{{$line_content}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </code>
                    </pre>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Resultados</h4>
                        </div>
                        <div class="card-body">
                            @if(count($file_results) > 0) 
                                <div class="row">
                                    <div class="container">
                                        <div class="col-md-12">
                                            <h2>Foram encontrados {{count($file_results)}} problemas!</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-flush">
                                    @foreach ($file_results as $results)
                                        <div class="list-group-item list-group-item-action line_result" id="line_result-{{$results->line_number}}">
                                            <div class="w-100">
                                                <h5 class="mb-1">Linha: {{$results->line_number}}</h5>
                                                <br>
                                                <p><span class="mb-1">Tipo do problema: </span><a href="">{{$results->term_type}}</a></p>
                                                <p class="mb-1">Problema: 
                                                    @if($results->term_type != "disabled_functions")
                                                    <a title="Clique aqui para ver a definição da função" target="_blank" href="https://www.php.net/manual/en/function.{{$results->term}}">{{$results->term}}</a>
                                                    @else
                                                        <span>{{$results->term}}</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="mb-1">Nenhum problema encontrado</span></p>
                            @endif
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    @endforeach
</div>
<button type="button" id="btn_scroll" class="btn btn-default">
    <i class="fa fa-chevron-up" aria-hidden="true"></i>
</button>
@endif


@endsection

{{-- @extends('templates.template')
@section('content')

<div class="col-md-12 mt-2">
    <div class="row">
        <div class="col-md-12">
            <a href="/yourfiles" class="btn btn-outline-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar</a>
        </div>
    </div>
    <br>
    @foreach ($file_results as $file_result)
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h1>Resultados</h1>
                    </div>
                    <div class="card-body">
                        @if(count($file_result) > 0) 
                            <div class="list-group-flush">
                                @foreach ($file_result as $results)
                                    <div class="list-group-item list-group-item-action line_result" id="line_result-{{$results->line_number}}">
                                        <div class="w-100">
                                            <h5 class="mb-1">Linha: {{$results->line_number}}</h5>
                                            <br>
                                            <p><span class="mb-1">Tipo do problema: </span><a href="">{{$results->term_type}}</a></p>
                                            <p class="mb-1">Problema: 
                                                @if($results->term_type != "disabled_functions")
                                                <a title="Clique aqui para ver a definição da função" target="_blank" href="https://www.php.net/manual/en/function.{{$results->term}}">{{$results->term}}</a>
                                                @else
                                                    <span>{{$results->term}}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="mb-1">Nenhum problema encontrado</span></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection --}}