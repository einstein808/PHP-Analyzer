<?php

namespace SegWeb\Http\Controllers;

use Illuminate\Http\Request;

class Tools extends Controller
{
    public function contains($needle, $haystack) {
        return strpos($haystack, $needle) !== false;
    }
}
