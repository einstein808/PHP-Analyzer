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
        return view('term_types', ['term_types'=>$this->getAll(), 'term_type'=>NULL]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if(empty($request->id)) {
            $term_type = new TermTypes();
            $msg['text'] = 'Termo inserido com sucesso!';
        } else {
            $term_type = TermTypes::find($request->id);
            $msg['text'] = 'Termo atualizado com sucesso!';
        }
        $term_type->term_type = $request->term_type;
        $term_type->color = $request->color;
        $term_type->save();
        $msg['type'] = 'success';
        $term_types = $this->getAll();
        return view('term_types', compact('msg', 'term_types'));
    }

    public function edit($id) {
        $term_type = TermTypes::findOrFail($id);
        $term_types = $this->getAll();
        return view('term_types', compact('term_types', 'term_type'));
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
