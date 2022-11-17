<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function show($id)
    {
//        dd($id);
//    dd($video);
//    $video = new stdClass();
//    $video->title = 'Ubuntu 101';
//    $video->description ='Here Description';
//    $video->published_at = 'December 13';

        return view('videos.show',[
            'video' => Video::find($id)
        ]);
        }
}
