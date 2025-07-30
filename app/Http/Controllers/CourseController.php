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

    // display all the courses
    public function index(){
        $courses = Course::all();
        return view("courses.index",['courses'=>$courses]);
    }

    // create and save a new course
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1',
        ]);

        // Check if a course already exists
        $exists = Course::whereRaw('LOWER(name) = ?', [strtolower($request->name)])->exists();
        if ($exists) {
            return redirect()->back()->withInput()->with('error', 'Course already exists.');
        }

        Course::create($request->all());

        return redirect()->route('courses.index')->with('success', 'Course added successfully.');
    }

    // edit/update a course
     public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'name' => 'string|max:255',
            'credits' => 'integer|min:1',
        ]);

        $course->update($validated);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    // delete a course
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}