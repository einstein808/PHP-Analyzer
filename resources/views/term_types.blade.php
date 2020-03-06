@extends('templates.template')
@section('content')
<div class="row mt-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="/term_types" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Cadastro de Tipos de Temos</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="term_type">Tipo de termo:</label><input type="text" name="term_type" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label for="color">Cor:</label><input type="text" name="color" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right">Enviar <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Tipos de Termos Cadastrados</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table">
                                @if (!empty($term_types))
                                    <table id="table_term_types" class="table table-hover table-bordered addDataTable">
                                        <thead>
                                            <tr>
                                                <th>Nome do tipo de termo</th>
                                                <th>Cor</th>
                                                <th>Data de Envio</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($term_types as $term_type)
                                            <tr class="clickable" onclick="document.location='/term_types/{{$term_type->id}}'">
                                                <td>{{$term_type->term_type}}</td>
                                                <td>{{$term_type->color}}</td>
                                                <td>{{$term_type->created_at}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    Nenhum tipo de termo encontrado!
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection