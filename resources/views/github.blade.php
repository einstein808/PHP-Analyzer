@extends('templates.template')
@section('content')

@if(!empty($file))
<div class="container">
    <h1>Repositório: {{$file->original_file_name}}</h1>
    @foreach($file_contents as $value)
        @php
            $file_content = $value['content'];
            $file_results = $value['results'];
            $file_repo_file = $value['file'];
            $file_path = explode('/', explode($file->original_file_name, $file_repo_file->file_path)[1]);
            unset($file_path[0]);
            $file_path = $file->original_file_name.'/'.implode('/', $file_path);
        @endphp
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>{{$file_path}}</h4>
                </div>
                <div class="card-body">
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
            </div>
        </div>
        
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">
                    <h4>Resultados do arquivo {{$file_path}}</h4>
                </div>
                <div class="card-body">
                    @if(count($file_results) > 0) 
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
        </div>
    @endforeach
</div>
<button type="button" id="btn_scroll" class="btn btn-default">
    <i class="fa fa-chevron-up" aria-hidden="true"></i>
</button>
@endif

<div class="row mt-2">
    <div class="container">
        <form action="/github" method="post" enctype="multipart/form-data" id="form_github">
            @csrf
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>
                            Enviar repositório do Github
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <input type="url" placeholder="https://github.com/mygithubprofile/mygithubproject" pattern="https://github.com/.*" name="github_link" id="github_link" class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <input type="text" name="branch" id="branch" placeholder="Branch ex:. master; prod; dev..." class="form-control" required>
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