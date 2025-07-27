
@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Add Student Score</h1>
    <form action="{{ route('scores.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="student_id" class="block text-gray-700">Student</label>
            <select name="student_id" id="student_id" class="w-full p-2 border rounded-md" required>
                <option value="">Select Student</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->student_id }})</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="course_id" class="block text-gray-700">Course</label>
            <select name="course_id" id="course_id" class="w-full p-2 border rounded-md" required>
                <option value="">Select Course</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }} ({{ $course->credits }} credits)</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="score" class="block text-gray-700">Score (0–100)</label>
            <input type="number" name="score" id="score" class="w-full p-2 border rounded-md" min="0" max="100" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Add Score</button>
    </form>
@endsection