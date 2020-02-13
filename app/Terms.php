<?php

namespace SegWeb;

use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    protected $filltable = [
        'term',
        'term_type',
        'color',
    ];
    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $table = 'terms';
}
