@extends('templates.template')
@section('content')
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
                                <input type="url" placeholder="https://github.com/myprofile/myproject" pattern="https://github.com/.*" name="github_link" id="github_link" class="form-control" required>
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