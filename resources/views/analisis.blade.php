@extends('templates.template')
@section('content')
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
            function listFolderFiles($dir) {
                $ffs = scandir($dir);

                unset($ffs[array_search('.', $ffs, true)]);
                unset($ffs[array_search('..', $ffs, true)]);

                echo '<ul>';
                foreach($ffs as $ff){
                    echo '<li><a href='.$dir.'/'.$ff.'>'.$ff.'</a>';
                    if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff);
                    echo '</li>';
                }
                echo '</ul>';
            }
            // Tools::listFolderFiles($file_location);
            listFolderFiles($file_location);
            @endphp 
        </div>
        <div class="col-md-9">
            <div id="result"></div>
        </div>
    </div>
@endsection