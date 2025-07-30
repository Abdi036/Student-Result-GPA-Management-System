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

    // saving a new score
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'score' => 'required|integer|min:0|max:100',
        ]);

        // Check for duplicate score
        $exists = Score::where('student_id', $request->student_id)
                       ->where('course_id', $request->course_id)
                       ->exists();

        if ($exists) {
            return back()->withInput()->withErrors(['course_id' => 'This subject is already added for this student.']);
        }

        Score::create($request->all());

        return back()->with('success', 'Score added successfully.');
    }

    // Update an existing score
    public function update(Request $request, $score)
    {
        $score = Score::findOrFail($score);

        $validated = $request->validate([
            'score' => 'required|numeric|min:0|max:100',
        ]);

        $score->update($validated);

        return redirect()->back()->with('success', 'Score updated successfully.');
    }
}