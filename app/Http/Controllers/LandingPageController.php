<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public static function testedBy(){
        return LandingPageControllerTest::class;
    }

    public function show()
    {
        return view('welcome');
    }

}
