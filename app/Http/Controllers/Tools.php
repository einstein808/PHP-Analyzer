<?php

namespace SegWeb\Http\Controllers;

class Tools extends Controller
{
    public function contains($needle, $haystack) {
        // melhorar para buscar o termo absoluto
        return strpos($haystack, $needle) !== false;
    }
}
