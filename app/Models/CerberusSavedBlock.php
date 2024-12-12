<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class CerberusSavedBlock extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'category',
        'type',
        'content',
        'thumbnail',
    ];

    protected $casts = [
        'content' => 'array',
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
            'footer' => 'Pie de página',
        ];
    }

    // Validar que el usuario no exceda el límite de bloques
    public static function userCanCreateBlock(int $userId): bool
    {
        return self::where('user_id', $userId)->count() < 10;
    }
}
