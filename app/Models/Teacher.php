<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';

    protected $fillable = [
        'id',
        'position_id',
        'image',
        'name',
        'slug',
        'status',
        'is_main',
        'order_by'
    ];

    protected $casts = [
        'is_main' => 'boolean',
        'position_id' => 'integer',
        'order_by' => 'integer',
        'name' => 'array',
        'slug' => 'array',
        'status' => 'boolean',
    ];

    public function position() {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }
}
