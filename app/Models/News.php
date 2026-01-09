<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'excerpt',
        'site_name',
        'image',
        'published_at',
        'sort_order',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
