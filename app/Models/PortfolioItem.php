<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    protected $fillable = [
        'role',
        'period',
        'company',
        'logo',
        'sort_order',
    ];
}
