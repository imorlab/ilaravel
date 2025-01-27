<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use App\Livewire\CerberusEditor;
use App\Livewire\Pro360Newsletter;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Livewire::component('cerberus-editor', CerberusEditor::class);
        Livewire::component('pro360-newsletter', Pro360Newsletter::class);
    }
}
