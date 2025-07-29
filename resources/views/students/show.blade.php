@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Student Details</h1>
    <div class="mb-4">
        <p><strong>Name:</strong> {{ $student->name }}</p>
        <p><strong>Student ID:</strong> {{ $student->student_id }}</p>
        <p><strong>GPA:</strong> {{ $student->calculateGPA() }}</p>
    </div>
    <h2 class="text-xl font-semibold text-gray-700 mb-2">Courses & Grades</h2>
    <table class="w-full bg-white shadow-md rounded-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4 text-left text-gray-600">Course</th>
                <th class="py-2 px-4 text-left text-gray-600">Score</th>
                <th class="py-2 px-4 text-left text-gray-600">Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student->scores as $score)
                <tr class="border-b">
                    <td class="py-2 px-4">{{ $score->course->name }}</td>
                    <td class="py-2 px-4">{{ $score->score }}</td>
                    <td class="py-2 px-4">{{ $student->getLetterGrade($score->score) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection