<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    // Show form to enter scores
    public function create()
    {
        $students = Student::all();
        $courses = Course::all();
        return view('scores.create', compact('students', 'courses'));
    }

    // Store a new score
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'score' => 'required|integer|min:0|max:100',
        ]);

        Score::create($request->all());

        return back()->with('success', 'Score added successfully.');
    }
}