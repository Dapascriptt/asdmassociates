<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'phone',
        'email',
        'email_alt',
        'address',
        'working_hours',
        'map_embed',
    ];
}
