<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $table = 'universities';

    protected $fillable = [
        'id',
        'country_id',
        'name',
        'slug',
        'image',
        'status',
        'is_main',
        'order_by'
    ];

    protected $casts = [
        'is_main' => 'boolean',
        'country_id' => 'integer',
        'order_by' => 'integer',
        'name' => 'array',
        'slug' => 'array',
        'status' => 'boolean',
    ];
}
