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
                    <blockquote>
                    {{-- <pre> --}}
                        <code style="color: black !important">
                        @foreach ($file_content as $key => $file)
                        @php
                        {{
                            $bg_color = 'bg-success';
                            if(!empty($file['warning'])) {
                                $bg_color = 'bg-warning';
                            }
                            if(!empty($file['danger'])) {
                                $bg_color = 'bg-danger';
                            }
                        }}    
                        @endphp
                            <div class="col-md-12 {{$bg_color}}">
                                <span>{{(1+$key). " - ". $file['text']}}</span>
                            </div>
                            @endforeach
                        </code>
                            {{-- </pre> --}}
                    </blockquote>
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
            <input type="file" name="file" id="file">
            <button type="submit">Enviar</button>
        </form>
    </div>
@endsection
