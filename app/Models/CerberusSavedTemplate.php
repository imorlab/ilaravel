<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class CerberusSavedTemplate extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'blocks',
        'thumbnail',
        'is_active'
    ];

    protected $casts = [
        'blocks' => 'array',
        'is_active' => 'boolean'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
