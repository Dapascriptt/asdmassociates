<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'position',
        'bio',
        'photo',
        'practice_areas',
        'sort_order',
    ];

    protected $casts = [
        'practice_areas' => 'array',
    ];
}

