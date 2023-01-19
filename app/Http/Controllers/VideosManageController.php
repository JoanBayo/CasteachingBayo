<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideosManageController extends Controller
{
    public static function testedBy()
    {
        return VideosManageController::class;
    }
    /**
     * R -> Retrive -> Llista
     */

    public function index()
    {
        return view('videos.manage.index',[
            'videos' => Video::all()
            ]);
    }

    /**
     * C -> Crate -> Mostrara el fomrulari de creacióE
     */
//    public function create()
//    {
//        //
//    }

    /**
     * C -> Crate -> Guardara a la base de dades el nou video
     */
    public function store(Request $request)
    {
        Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
        ]);
        session()->flash('status','Successfully created');

        return redirect()->route('manage.videos');
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
