<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NotchNav extends Component
{
    public function __construct()
    {
    }

    public function render()
    {
        return view('components.notch-nav');
    }
}
