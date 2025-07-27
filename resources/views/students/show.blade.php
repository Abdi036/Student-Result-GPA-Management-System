@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $student->name }} ({{ $student->student_id }})</h1>
    <div class="mb-4">
        <span class="font-semibold">GPA:</span> {{ $student->calculateGPA() }}
    </div>
    <h2 class="text-xl font-bold text-gray-700 mb-2">Courses & Scores</h2>
    <div class="overflow-x-auto">
        <table class="w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 text-left text-gray-600">Course Name</th>
                    <th class="py-2 px-4 text-left text-gray-600">Credits</th>
                    <th class="py-2 px-4 text-left text-gray-600">Score</th>
                    <th class="py-2 px-4 text-left text-gray-600">Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($student->scores as $score)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $score->course->name }}</td>
                        <td class="py-2 px-4">{{ $score->course->credits }}</td>
                        <td class="py-2 px-4">{{ $score->score }}</td>
                        <td class="py-2 px-4">{{ $student->getLetterGrade($score->score) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        <a href="{{ route('students.index') }}" class="text-blue-500 hover:underline">&larr; Back to Student List</a>
    </div>
@endsection
