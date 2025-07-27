@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Add New Student</h1>
    <form action="{{ route('students.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="w-full p-2 border rounded-md" required>
        </div>
        <div>
            <label for="student_id" class="block text-gray-700">Student ID</label>
            <input type="text" name="student_id" id="student_id" class="w-full p-2 border rounded-md" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Add Student</button>
    </form>
@endsection



