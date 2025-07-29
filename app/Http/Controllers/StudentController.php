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

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }
    // Show a single student
    public function show(Student $student)
    {
        $student->load('scores.course');
        return view('students.show', compact('student'));
    }
}