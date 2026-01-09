<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'position',
        'phone',
        'email',
        'linkedin',
        'photo',
        'overview',
        'experience_highlights',
        'sort_order',
    ];

    protected $casts = [
        'experience_highlights' => 'array',
    ];
}
