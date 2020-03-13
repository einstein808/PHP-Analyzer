<?php

namespace SegWeb\Http\Controllers;

use SegWeb\File;
use SegWeb\FileResults;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FileResultsController extends Controller {
    public function getAllByFileId($file_id) {
        $file = File::find($file_id);
        $return_collection = [];
        if($file->type == 'File') {
            $return_collection[] = DB::table('file_results')
                    ->leftJoin('terms', 'file_results.term_id', '=', 'terms.id')
                    ->leftJoin('term_types', 'terms.term_type_id', '=', 'term_types.id')
                    ->where('file_results.file_id', $file_id)
                    ->get(['line_number', 'term', 'term_type', 'color']);
        } else {
            $fileController = new FileController();
            $github_files = $fileController->getGithubFiles($file_id);
            
            if(!empty($github_files)) {
                foreach($github_files as $github_file) {
                    $return_collection[] = DB::table('file_results')
                    ->leftJoin('terms', 'file_results.term_id', '=', 'terms.id')
                    ->leftJoin('term_types', 'terms.term_type_id', '=', 'term_types.id')
                    ->where('file_results.file_id', $github_file->id)
                    ->get(['line_number', 'term', 'term_type', 'color']);
                }
            }
        }
        return $return_collection;
    }

    public function getSingleByFileId($file_id) {
        return DB::table('file_results')
                ->leftJoin('terms', 'file_results.term_id', '=', 'terms.id')
                ->leftJoin('term_types', 'terms.term_type_id', '=', 'term_types.id')
                ->where('file_results.file_id', $file_id)
                ->get(['line_number', 'term', 'term_type', 'color']);
    }

    public function showFileResults($file_id) {
        $file = File::find($file_id);
        $file_results = $this->getAllByFileId($file_id);
        return view('file_results', compact('file_results'));
    }

    // public function countResultsByFileId($file_id) {
    //     return DB::table('file_results')
    //                 ->where('file_id', $file_id)
    //                 ->count();
    // }
}

