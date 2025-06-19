<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $fillable = [
        'id',
        'name',
        'slug',
        'image',
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

    public function universities() {
        return $this->hasMany(University::class,'country_id','id')->where(['status' => 1])->orderBy('name->az','ASC');
    }
}
