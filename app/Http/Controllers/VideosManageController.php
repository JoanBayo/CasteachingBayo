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
     * U -> upadte -> Form
     */
    public function edit($id)
    {
        return view('videos.manage.edit',['video' => Video::findOrFail($id) ]);
    }

    /**
     * U -> upadte -> Processarà el Format i guardaara les modificacions
     */
    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);
        $video->title = $request->title;
        $video->description = $request->description;
        $video->url = $request->url;
        $video->save();

        session()->flash('status', 'Successfully updated');
        return redirect()->route('manage.videos');
    }

    /**
     * D -> Delete
     */
    public function destroy($id)
    {
        Video::find($id)->delete();
        session()->flash('status','Successfully deleted');
        return redirect()->route('manage.videos');

    }
}
