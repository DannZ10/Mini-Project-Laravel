<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'instructor_id', 'category_id', 'title', 'description', 'price', 'quota',
        'rating', 'thumbnail', 'level', 'duration', 'status', 'enrolled_count'
    ];

    public function getRatingClassAttribute()
    {
        if ($this->rating >= 8.5) return 'Top Rated';
        if ($this->rating >= 7.0) return 'Recommended';
        return 'Regular';
    }

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
