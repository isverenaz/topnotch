<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory;

    protected $table = 'course_categories';

    protected $fillable = [
        'id',
        'title',
        'slug',
        'order_by',
        'status',
    ];

    protected $casts = [
        'title' => 'array',
        'slug' => 'array',
        'order_by' => 'integer',
        'status' => 'boolean',
    ];

    public function languageCourses()
    {
        return $this->hasMany(LanguageCourse::class, 'course_category_id', 'id')->where('status', 1)->orderByDesc('id');
    }
}
