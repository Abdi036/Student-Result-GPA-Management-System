@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Student List</h1>
    <div class="overflow-x-auto">
        <table class="w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 text-left text-gray-600">Name</th>
                    <th class="py-2 px-4 text-left text-gray-600">Student ID</th>
                    <th class="py-2 px-4 text-left text-gray-600">GPA</th>
                    <th class="py-2 px-4 text-left text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $student->name }}</td>
                        <td class="py-2 px-4">{{ $student->student_id }}</td>
                        <td class="py-2 px-4">{{ $student->calculateGPA() }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('students.show', $student->id) }}" class="text-blue-500 hover:underline">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

