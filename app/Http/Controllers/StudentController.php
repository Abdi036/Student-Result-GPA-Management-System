<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Show all students sorted by GPA
    public function index()
    {
        $students = Student::with('scores')->get()->sortByDesc(function ($student) {
            return $student->calculateGPA();
        });

        return view('students.index', compact('students'));
    }

    // Show form to create a student
    public function create()
    {
        return view('students.create');
    }

    // Store a new student
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|string|max:10|unique:students',
        ]);

        if (Student::where('student_id', $request->student_id)->exists()) {
            return redirect()->back()->withErrors(['student_id' => 'This student ID is already taken.']);
        }

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }
    // Show a single student
    public function show(Student $student)
    {
        $student->load('scores.course');
        return view('students.show', compact('student'));
    }

    // Update a student
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|string|max:10|unique:students,student_id,' . $student->id,
        ]);

        $student->update($validated);

        return redirect()->route('students.show', $student)->with('success', 'Student updated successfully.');
    }

    // Delete a student
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}