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
        if ($score >= 90) return 4.0; // A
        if ($score >= 80) return 3.0; // B
        if ($score >= 70) return 2.0; // C
        if ($score >= 60) return 1.0; // D
        return 0.0; // F
    }

    // Get letter grade
    public function getLetterGrade($score)
    {
        if ($score >= 90) return 'A';
        if ($score >= 80) return 'B';
        if ($score >= 70) return 'C';
        if ($score >= 60) return 'D';
        return 'F';
    }
}