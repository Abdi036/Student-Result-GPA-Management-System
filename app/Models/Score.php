<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = ['student_id', 'course_id', 'score'];

    // A score belongs to a student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // A score belongs to a course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}