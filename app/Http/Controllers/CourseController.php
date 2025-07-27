<?php
namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Show form to create a course
    public function create()
    {
        return view('courses.create');
    }

    // Store a new course
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1',
        ]);

        Course::create($request->all());

        return redirect()->route('students.index')->with('success', 'Course added successfully.');
    }
}