<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\WeatherService;
use App\Services\RssService;
use App\Models\Activity;

class Sidebar extends Component
{
    public $isOpen = false;
    public $weather;
    public $activities;
    public $news;

    protected $listeners = ['refreshWeather', 'refreshActivities', 'refreshNews'];

    public function mount()
    {
        $this->isOpen = false;
        $this->refreshWeather();
        $this->refreshActivities();
        $this->refreshNews();
    }

    public function toggleSidebar()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function refreshWeather()
    {
        $weatherService = app(WeatherService::class);
        $this->weather = $weatherService->getCurrentWeather();
    }

    public function refreshActivities()
    {
        $this->activities = Activity::getRecentActivities();
    }

    public function refreshNews()
    {
        $rssService = app(RssService::class);
        $this->news = $rssService->getNews();
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}
