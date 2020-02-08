<?php

namespace SegWeb;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $filltable = [
        'user_id',
        'arquivo',
        'nome_original',
        'type'
    ];
    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $table = 'files';
}
