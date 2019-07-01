<?php

namespace SegWeb;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $filltable = [
        'arquivo',
        'nome_original'
    ];
    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $table = 'files';
}
