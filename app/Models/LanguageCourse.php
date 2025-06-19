<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageCourse extends Model
{
    use HasFactory;

    protected $table = 'language_courses';


    protected $fillable = [
        'id',
        'language_id',
        'parent_language_id',
        'teacher_id',
        'name',
        'slug',
        'text',
        'full_text',
        'image',
        'status',
        'is_main',
        'order_by',
        'campaign',
        'is_campaign'
    ];

    protected $casts = [
        'is_main' => 'boolean',
        'language_id' => 'integer',
        'parent_language_id' => 'integer',
        'teacher_id' => 'integer',
        'order_by' => 'integer',
        'name' => 'array',
        'slug' => 'array',
        'text' => 'array',
        'full_text' => 'array',
        'campaign' => 'array',
        'status' => 'boolean',
        'is_campaign' => 'boolean',
    ];

    public function parentLanguage() {
        return $this->hasOne(Language::class,'id','parent_language_id');
    }

    public function language() {
        return $this->hasOne(Language::class,'id','language_id');
    }
    public function leve() {
        return $this->hasOne(Language::class,'id','parent_language_id');
    }

    public function teacher() {
        return $this->hasOne(Teacher::class,'id','teacher_id');
    }
}
