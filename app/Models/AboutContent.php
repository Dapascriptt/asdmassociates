<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    protected $fillable = [
        'intro_1',
        'intro_2',
        'about_images',
        'hero_title',
        'hero_subtitle',
        'hero_points',
        'vision',
        'mission',
        'hero_image',
    ];

    protected $casts = [
        'about_images' => 'array',
        'hero_points' => 'array',
    ];
}
