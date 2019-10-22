@extends('templates.template')
@section('content')
@php use SegWeb\Http\Controllers\Tools;@endphp
    {{-- @section('analisis')
        <div class="logo">
            <div class='mouse-hover text-primary'><h4>nome do diretorio</h4></div>
        </div>
        <ul class="nav">
            <li class="">
                <a href='autores.php'>
                    <i class="ti-user"></i>
                    <p>pastas</p>
                </a>
            </li>
        </ul>
    @endsection --}}
    <div class="row">
        <div class="col-md-3">
            @php
            Tools::listFolderFiles($file_location);
            @endphp 
        </div>
        <div class="col-md-9">
            <div id="result"></div>
        </div>
    </div>
@endsection