<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';

    protected $fillable = [
        'id',
        'name',
        'slug',
        'status',
        'is_main',
        'order_by'
    ];

    protected $casts = [
        'is_main' => 'boolean',
        'order_by' => 'integer',
        'name' => 'array',
        'slug' => 'array',
        'status' => 'boolean',
    ];
}
