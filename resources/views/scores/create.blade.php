@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Add Student Score</h1>

    @if ($errors->any())
        <div id="error-alert" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <script>
            setTimeout(function() {
                var alert = document.getElementById('error-alert');
                if (alert) alert.style.display = 'none';
            }, 3000);
        </script>
    @endif

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