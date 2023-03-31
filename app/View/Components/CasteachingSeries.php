<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Tests\Feature\CasteachingSeriesTest;

class CasteachingSeries extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public static function testedBy()
    {
        return CasteachingSeriesTest::class;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.casteaching-series');
    }
}
