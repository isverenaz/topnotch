<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commit extends Model
{
    use HasFactory;

    protected $table = 'commits';
    protected $fillable = [
        'image',
        'name',
        'slug',
        'description'
        ,'datetime'
    ];

    protected $casts = [
        'datetime' => 'datetime',
        'name' => 'array',
        'slug' => 'array',
        'description' => 'array',
    ];
}
