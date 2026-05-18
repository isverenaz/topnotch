<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = [
        'title',
        'sub_title',
        'text',
        'image',
        'status',
    ];

    protected $casts = [
        'title' => 'array',
        'sub_title' => 'array',
        'text' => 'array',
    ];
}
