<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Newsletter extends Model
{
    use HasFactory, SoftDeletes, RecordsActivity;

    protected $fillable = [
        'email',
        'content',
        'sent_at',
        'status',
        'subject'
    ];

    protected $dates = [
        'sent_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected function getActivityType(): string
    {
        return 'newsletter';
    }

    protected function getActivityTitle(string $action): string
    {
        return 'Newsletter ' . ($action === 'created' ? 'enviada' : 'actualizada');
    }

    protected function getActivityDescription(string $action): string
    {
        return $action === 'created' 
            ? "Newsletter \"{$this->subject}\" enviada exitosamente"
            : "Newsletter \"{$this->subject}\" actualizada";
    }

    public static function countThisMonth()
    {
        return static::whereMonth('sent_at', now()->month)
                    ->whereYear('sent_at', now()->year)
                    ->count();
    }

    public static function getMonthlyStats()
    {
        return static::select(
            DB::raw('MONTH(sent_at) as month'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('sent_at', now()->year)
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('total', 'month')
        ->map(function ($value, $month) {
            return [
                'month' => date('M', mktime(0, 0, 0, $month, 1)),
                'total' => $value
            ];
        })->values();
    }
}
