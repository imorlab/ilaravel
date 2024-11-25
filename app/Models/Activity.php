<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'description',
        'subject_type',
        'subject_id'
    ];

    public function subject()
    {
        return $this->morphTo();
    }

    public static function getRecentActivities($limit = 5)
    {
        return static::latest()
            ->take($limit)
            ->get()
            ->map(function ($activity) {
                return [
                    'title' => $activity->title,
                    'description' => $activity->description,
                    'time_ago' => Carbon::parse($activity->created_at)->diffForHumans(),
                ];
            });
    }
}
