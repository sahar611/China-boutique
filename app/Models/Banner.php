<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title', 'title_ar',
        'description', 'description_ar',
        'image', 'url',
        'status'
    ];
}
