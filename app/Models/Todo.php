<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Todo extends Model
{
    use HasFactory, RecordsActivity;

    protected $fillable = ['task', 'status', 'order', 'group', 'time_spent', 'is_paused'];

    protected function getActivityType(): string
    {
        return 'task';
    }

    protected function getActivityTitle(string $action): string
    {
        if ($action === 'updated' && $this->isDirty('status') && $this->status === 'completed') {
            return 'Tarea completada';
        }
        
        $actions = [
            'created' => 'creada',
            'updated' => 'actualizada',
            'deleted' => 'eliminada'
        ];
        return 'Tarea ' . ($actions[$action] ?? $action);
    }

    protected function getActivityDescription(string $action): string
    {
        if ($action === 'updated' && $this->isDirty('status') && $this->status === 'completed') {
            return "Tarea \"{$this->task}\" marcada como completada";
        }
        
        return "Tarea \"{$this->task}\" " . ($action === 'created' ? 'creada' : 'actualizada') . 
               ($this->group ? " en grupo {$this->group}" : '');
    }

    public static function getPendingTasksCount()
    {
        return static::where('status', '!=', 'completed')->count();
    }

    public static function getPendingTasksForToday()
    {
        return static::where('status', '!=', 'completed')
            ->whereDate('created_at', today())
            ->count();
    }

    public static function getCompletedTasksThisWeek()
    {
        return static::where('status', 'completed')
            ->whereBetween('updated_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])
            ->count();
    }

    public static function getWeeklyCompletedTasks()
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        
        $dailyTasks = static::select(
            DB::raw('DATE(updated_at) as date'),
            DB::raw('COUNT(*) as total')
        )
        ->where('status', 'completed')
        ->whereBetween('updated_at', [$startOfWeek, $endOfWeek])
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $weekDays = [];
        $currentDay = $startOfWeek->copy();

        while ($currentDay <= $endOfWeek) {
            $date = $currentDay->format('Y-m-d');
            $count = $dailyTasks->firstWhere('date', $date)?->total ?? 0;
            $weekDays[$currentDay->format('D')] = $count;
            $currentDay->addDay();
        }

        return $weekDays;
    }
}
