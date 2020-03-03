<?php

namespace SegWeb\Http\Controllers;

use SegWeb\FileResults;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FileResultsController extends Controller {
    public function getAllByFileId($file_id) {
        return DB::table('file_results')
                ->leftJoin('terms', 'file_results.term_id', '=', 'terms.id')
                ->leftJoin('term_types', 'terms.term_type_id', '=', 'term_types.id')
                ->where('file_results.file_id', $file_id)
                ->get(['line_number', 'term', 'term_type', 'color']);
    }
    public function showFileResults($file_id) {
        $file_results = $this->getAllByFileId($file_id);
        return view('file_results', compact('file_results'));
    }
}

