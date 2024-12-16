<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class CerberusSavedTemplate extends Model
{
    protected $fillable = [
        'name',
        'description',
        'blocks',
        'is_default',
        'user_id'
    ];

    protected $casts = [
        'blocks' => 'array',
        'is_default' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
