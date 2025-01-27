<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CerberusTemplate extends Model
{
    protected $fillable = ['name', 'blocks', 'is_active'];
    
    protected $casts = [
        'blocks' => 'array',
        'is_active' => 'boolean'
    ];
}
