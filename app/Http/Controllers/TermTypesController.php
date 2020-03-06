<?php

namespace SegWeb\Http\Controllers;

use SegWeb\TermTypes;
use Illuminate\Http\Request;

class TermTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('term_types', ['term_types'=>$this->getAll()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $term_type = new TermTypes();
        $term_type->term_type = $request->term_type;
        $term_type->color = $request->color;
        $term_type->save();
        $msg = [
            'type' => 'success',
            'text' => 'Termo inserido com sucesso!'
        ];
        $term_types = TermTypes::all();
        return view('term_types', compact('msg', 'term_types'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \SegWeb\TermTypes  $termTypes
     * @return \Illuminate\Http\Response
     */
    public function show(TermTypes $termTypes) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SegWeb\TermTypes  $termTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(TermTypes $termTypes) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SegWeb\TermTypes  $termTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TermTypes $termTypes) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SegWeb\TermTypes  $termTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermTypes $termTypes) {
        //
    }

    public function getAll() {
        return TermTypes::all();
    }
}
