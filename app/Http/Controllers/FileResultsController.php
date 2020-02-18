<?php

namespace SegWeb\Http\Controllers;

use SegWeb\FileResults;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FileResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \SegWeb\FileResults  $fileResults
     * @return \Illuminate\Http\Response
     */
    public function show(FileResults $fileResults)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SegWeb\FileResults  $fileResults
     * @return \Illuminate\Http\Response
     */
    public function edit(FileResults $fileResults)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SegWeb\FileResults  $fileResults
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileResults $fileResults)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SegWeb\FileResults  $fileResults
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileResults $fileResults)
    {
        //
    }

    public function getAllByFileId($file_id) {
        return DB::table('file_results')
                ->leftJoin('terms', 'file_results.term_id', '=', 'terms.id')
                ->leftJoin('term_types', 'terms.term_type_id', '=', 'term_types.id')
                ->where('file_results.file_id', $file_id)
                ->get(['line_number', 'line_content', 'term', 'term_type', 'color']);
    }
}
