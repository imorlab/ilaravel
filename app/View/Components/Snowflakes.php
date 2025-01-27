<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Snowflakes extends Component
{
    public $showChristmasElements;

    public function __construct()
    {
        $this->showChristmasElements = env('SHOW_CHRISTMAS_ELEMENTS', false);
    }

    public function render()
    {
        if (!$this->showChristmasElements) {
            return '';
        }
        return view('components.snowflakes');
    }
}
