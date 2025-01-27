<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes, RecordsActivity;

    protected $fillable = [
        'title',
        'content',
        'category',
        'is_favorite'
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
    ];

    protected function getActivityType(): string
    {
        return 'note';
    }

    protected function getActivityTitle(string $action): string
    {
        $actions = [
            'created' => 'creada',
            'updated' => 'actualizada',
            'deleted' => 'eliminada'
        ];
        return 'Nota ' . ($actions[$action] ?? $action);
    }

    protected function getActivityDescription(string $action): string
    {
        return "Nota \"{$this->title}\" " . ($action === 'created' ? 'creada' : 'actualizada') . 
               ($this->category ? " en categoría {$this->category}" : '');
    }

    public static function getActiveNotesCount()
    {
        return static::whereNull('deleted_at')->count();
    }
}
