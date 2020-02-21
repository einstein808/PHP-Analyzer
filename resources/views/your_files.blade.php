@extends('templates.template')
@section('content')
@php use SegWeb\Http\Controllers\Tools;@endphp
<div class="row mt-2">
    <div class="container">
        <div class="table-responsive">
            <table id="table-yourfiles" class="table table-striped table-bordered addDataTable">
                <thead>
                    <tr>
                        <th>Nome do arquivo</th>
                        <th>Data de Envio</th>
                        <th>Forma de envio</th>
                        <th>Resultados</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($files as $file)
                    <tr>
                        <td>{{$file->original_file_name}}</td>
                        <td>{{Tools::data($file->created_at)}}</td>
                        <td>{{$file->type}}</td>
                        <td><a href="/yourfiles/{{$file->id}}" class="btn btn-outline-info">Resultados</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection