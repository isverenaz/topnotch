<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolCategory extends Model
{
    use HasFactory;

    protected $table = 'school_categories';

    protected $fillable = [
        'id',
        'title',
        'slug',
        'order_by',
        'status'
    ];

    protected $casts = [
        'title' => 'array',
        'slug' => 'array',
    ];

}
