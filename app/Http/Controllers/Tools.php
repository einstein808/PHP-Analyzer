<?php

namespace SegWeb\Http\Controllers;

class Tools extends Controller
{
    public function contains($needle, $haystack) {
        return strpos($haystack, $needle) !== false;
    }
}
