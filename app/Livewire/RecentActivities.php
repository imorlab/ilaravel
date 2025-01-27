<?php

namespace App\Livewire;

use App\Models\Activity;
use Livewire\Component;

class RecentActivities extends Component
{
    public $activities = [];
    public $limit = 5;

    public function mount()
    {
        $this->loadActivities();
    }

    public function loadActivities()
    {
        $this->activities = Activity::getRecentActivities($this->limit);
    }

    public function render()
    {
        return view('livewire.recent-activities');
    }
}
