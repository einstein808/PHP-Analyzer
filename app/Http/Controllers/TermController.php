<?php

namespace SegWeb\Http\Controllers;

use Illuminate\Http\Request;
use SegWeb\Terms;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('terms', ['terms'=>$this->getAll(), 'term'=>NULL]);
    }

    public function edit($id) {
        $term_type = TermTypes::findOrFail($id);
        $term_types = $this->getAll();
        return view('term_types', compact('term_types', 'term_type'));
    }

    public function getTerm($id=NULL) {
        return empty($id) ? Terms::get() : Terms::where('id', $id)->get();
    }

    public function getAll() {
        return Terms::all();
    }
}
