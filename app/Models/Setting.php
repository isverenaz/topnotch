<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'id',
        'header_logo',
        'footer_logo',
        'favicon',
        'title',
        'text',
        'address',
        'phone',
        'email',
        'instagram',
        'telegram',
        'whatsapp',
        'youtube',
        'linkedin',
        'twitter',
    ];

    protected $casts = [
        'title' => 'array',
        'text' => 'array',
        'address' => 'array',
    ];
}
