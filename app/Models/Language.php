<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';

    protected $fillable = [
        'id',
        'parent_id',
        'teacher_id',
        'name',
        'slug',
        'image',
        'status',
        'is_main',
        'order_by'
    ];

    protected $casts = [
        'is_main' => 'boolean',
        'parent_id' => 'integer',
        'teacher_id' => 'integer',
        'order_by' => 'integer',
        'name' => 'array',
        'slug' => 'array',
        'status' => 'boolean',
    ];

    public function parentLanguages() {
        return $this->hasMany(Language::class, 'parent_id','id');
    }
}
