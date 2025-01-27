<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class CerberusSavedBlock extends Model
{
    protected $fillable = [
        'name',
        'type',
        'content',
        'category',
        'is_active',
        'user_id',
        'thumbnail',
    ];

    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Categorías disponibles
    public static function categories(): array
    {
        return [
            'header' => 'Cabeceras',
            'content' => 'Contenido',
            'button' => 'Botones',
            'hero' => 'Hero',
            'footer' => 'Pie de página',
            'two-columns-left' => 'Dos columnas izquierda',
            'two-columns-right' => 'Dos columnas derecha',
        ];
    }

    // Validar que el usuario no exceda el límite de bloques
    public static function userCanCreateBlock(int $userId): bool
    {
        return self::where('user_id', $userId)->count() < 10;
    }
}
