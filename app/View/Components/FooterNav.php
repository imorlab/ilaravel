<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class FooterNav extends Component
{
    public bool $showFooter;

    public function __construct()
    {
        $this->showFooter = !Route::is('home');
    }

    public function render()
    {
        return view('components.footer-nav');
    }
}
