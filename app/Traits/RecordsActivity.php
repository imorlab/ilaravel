<?php

namespace App\Traits;

use App\Models\Activity;

trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        static::created(function ($model) {
            $model->recordActivity('created');
        });

        static::updated(function ($model) {
            $model->recordActivity('updated');
        });

        static::deleted(function ($model) {
            $model->recordActivity('deleted');
        });
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    protected function recordActivity($type)
    {
        $this->activities()->create([
            'type' => $this->getActivityType(),
            'title' => $this->getActivityTitle($type),
            'description' => $this->getActivityDescription($type),
        ]);
    }

    abstract protected function getActivityType(): string;
    abstract protected function getActivityTitle(string $action): string;
    abstract protected function getActivityDescription(string $action): string;
}
