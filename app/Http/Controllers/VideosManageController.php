<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideosManageController extends Controller
{
    /**
     * R -> Retrive -> Llista
     */
    public function index()
    {
        //dd('hola');
        return view('videos.manage.index');
    }

    /**
     * C -> Crate -> Mostrara el fomrulari de creació
     */
    public function create()
    {
        //
    }

    /**
     * C -> Crate -> Guardara a la base de dades el nou video
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * R -> NO LLISTA -> Individual ->
     */
    public function show($id)
    {
        //
    }

    /**
     * U -> upadte -> Form
     */
    public function edit($id)
    {
        //
    }

    /**
     * U -> upadte -> Processarà el Format i guardaara les modificacions
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * D -> Delete
     */
    public function destroy($id)
    {
        //
    }
}
