<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';

    protected $fillable = [
        'id',
        'category_id',
        'country_id',
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

    public function category() {
        return $this->hasOne(SchoolCategory::class, 'id', 'category_id');
    }

    public function language() {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }
    public function leve() {
        return $this->hasOne(Language::class, 'id', 'parent_language_id');
    }
    public function parentLanguage() {
        return $this->hasOne(Language::class, 'id', 'parent_language_id');
    }
    public function teacher() {
        return $this->hasOne(Teacher::class, 'id', 'teacher_id');
    }
    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }
}
