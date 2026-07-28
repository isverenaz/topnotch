<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EducationalDegree;

class StudyAbroad extends Model
{
    use HasFactory;

    protected $table = 'study_abroads';

    protected $fillable = [
        'id',
        'country_id',
        'university_id',
        'degree_id',
        'name',
        'slug',
        'text',
        'full_text',
        'image',
        'status',
        'is_main'
    ];

    protected $casts = [
        'is_main' => 'boolean',
        'country_id' => 'integer',
        'university_id' => 'integer',
        'degree_id' => 'integer',
        'order_by' => 'integer',
        'name' => 'array',
        'slug' => 'array',
        'text' => 'array',
        'full_text' => 'array',
        'status' => 'boolean',
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }
    public function university() {
        return $this->belongsTo(University::class);
    }
    public function degree() {
        return $this->belongsTo(EducationalDegree::class, 'degree_id', 'id');
    }
}
