@extends('templates.template')
@section('content')

<div class="col-md-12 mt-2">
    <div class="row">
        <div class="col-md-12">
            <a href="/yourfiles" class="btn btn-outline-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar</a>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            {{-- MOSTRAR O NOME DO ARQUIVO!!!!!! --}}
            <h1>Resultados</h1>
        </div>
        <div class="card-body">
            @if(count($file_results) > 0) 
                <div class="list-group-flush">
                    @foreach ($file_results as $results)
                        <div class="list-group-item list-group-item-action line_result" id="line_result-{{$results->line_number}}">
                            <div class="w-100">
                                <h5 class="mb-1">Linha: {{$results->line_number}}</h5>
                                <br>
                                <p><span class="mb-1">Tipo do erro: </span><a href="">{{$results->term_type}}</a></p>
                                <p class="mb-1">Erro: <span>{{$results->term}}</span></p>
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

@endsection