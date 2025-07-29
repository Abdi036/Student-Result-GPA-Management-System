<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'student_id'];

    // A student has many scores
    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    // Calculate GPA
    public function calculateGPA()
    {
        $scores = $this->scores()->with('course')->get();
        if ($scores->isEmpty()) {
            return 0.0;
        }

        $totalPoints = 0;
        $totalCredits = 0;

        foreach ($scores as $score) {
            $gradePoint = $this->scoreToGradePoint($score->score);
            $totalPoints += $gradePoint * $score->course->credits;
            $totalCredits += $score->course->credits;
        }

        return $totalCredits > 0 ? round($totalPoints / $totalCredits, 2) : 0.0;
    }

    // Convert score to grade point
    private function scoreToGradePoint($score)
    {
        if ($score >= 90) return 4.0; 
        if ($score >= 80) return 3.0; 
        if ($score >= 70) return 2.0; 
        if ($score >= 60) return 1.0; 
        return 0.0; 
    }

    // Get letter grade
    public function getLetterGrade($score)
    {
        if ($score >= 90) return 'A+';
        if ($score < 90 && $score >= 85) return 'A';
        if ($score >= 80 && $score < 85) return 'A-';
        if ($score >= 75 && $score < 80) return 'B+';
        if ($score >= 70 && $score < 75) return 'B';
        if ($score >= 65 && $score < 70) return 'B-';
        if ($score >= 60 && $score < 65) return 'C+';
        if ($score >= 50 && $score < 60) return 'C';
        if ($score >= 45 && $score < 50) return 'C-';
        if ($score >= 40 && $score < 45) return 'D';
        return 'F';
    }
}