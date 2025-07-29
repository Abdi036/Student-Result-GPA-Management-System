@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl p-8 mb-8">
        <h1 class="text-3xl font-extrabold text-blue-900 mb-6 text-center">Student Details</h1>
        <div id="student-info" class="mb-6">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="text-lg font-semibold text-gray-700">Name:</p>
                    <span id="student-name" class="text-xl text-blue-800">{{ $student->name }}</span>
                </div>
                <div>
                    <p class="text-lg font-semibold text-gray-700">Student ID:</p>
                    <span id="student-id" class="text-xl text-blue-800">{{ $student->student_id }}</span>
                </div>
            </div>
            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-700">GPA:</p>
                <span class="text-2xl font-bold text-green-700">{{ $student->calculateGPA() }}</span>
            </div>
            <div class="flex space-x-2">
                <button onclick="showEditForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow font-semibold transition">Edit</button>
                <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow font-semibold transition" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                </form>
            </div>
        </div>
        <!-- Inline Edit Form (hidden by default) -->
        <div id="edit-form" style="display:none;" class="mb-6">
            <form action="{{ route('students.update', $student->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                <div>
                    <label for="name" class="block text-gray-700 font-semibold">Name</label>
                    <input type="text" name="name" id="name" value="{{ $student->name }}" class="w-full p-2 border border-blue-300 rounded-md focus:ring focus:ring-blue-200" required>
                </div>
                <div>
                    <label for="student_id" class="block text-gray-700 font-semibold">Student ID</label>
                    <input type="text" name="student_id" id="student_id" value="{{ $student->student_id }}" class="w-full p-2 border border-blue-300 rounded-md focus:ring focus:ring-blue-200" required>
                </div>
                <div class="flex space-x-2">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow font-semibold transition">Save</button>
                    <button type="button" onclick="hideEditForm()" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded shadow font-semibold transition">Cancel</button>
                </div>
            </form>
            @if ($errors->any())
                <div id="error-alert" class="bg-red-100 border-l-4 mt-2 border-red-500 text-red-700 p-2 mb-2 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-xl p-8 mb-5">
        <h2 class="text-2xl font-bold text-blue-900 mb-4 text-center">Courses & Grades</h2>
        <table class="w-full bg-white rounded-lg overflow-hidden shadow">
            <thead class="bg-blue-100">
                <tr>
                    <th class="py-3 px-4 text-left text-blue-700 font-semibold">Course</th>
                    <th class="py-3 px-4 text-left text-blue-700 font-semibold">Score</th>
                    <th class="py-3 px-4 text-left text-blue-700 font-semibold">Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($student->scores as $score)
                    <tr class="border-b" id="score-row-{{ $score->id }}">
                        <td class="py-3 px-4">{{ $score->course->name }}</td>
                        <td class="py-3 px-4">
                            <span id="score-value-{{ $score->id }}"
                                  onclick="showScoreEditForm({{ $score->id }})"
                                  class="cursor-pointer bg-yellow-50 hover:bg-yellow-200 px-3 py-1 rounded transition font-semibold text-yellow-900 shadow-inner"
                                  title="Click to edit score">
                                {{ $score->score }}
                            </span>
                        </td>
                        <td class="py-3 px-4 font-bold text-green-700">{{ $student->getLetterGrade($score->score) }}</td>
                    </tr>
                    <!-- Inline Edit Form (hidden by default) -->
                    <tr id="score-edit-form-{{ $score->id }}" style="display:none;">
                        <td colspan="3" class="py-3 px-4 bg-yellow-50">
                            <form action="{{ route('scores.update', $score->id) }}" method="POST" class="flex space-x-2 items-center">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="score" value="{{ $score->score }}" min="0" max="100" class="border border-yellow-300 px-2 py-1 rounded focus:ring focus:ring-yellow-200 font-semibold" required>
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow font-semibold transition">Save</button>
                                <button type="button" onclick="hideScoreEditForm({{ $score->id }})" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded shadow font-semibold transition">Cancel</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    function showEditForm() {
        document.getElementById('student-info').style.display = 'none';
        document.getElementById('edit-form').style.display = '';
    }
    function hideEditForm() {
        document.getElementById('student-info').style.display = '';
        document.getElementById('edit-form').style.display = 'none';
    }
    function showScoreEditForm(id) {
        document.getElementById('score-edit-form-' + id).style.display = '';
        document.getElementById('score-row-' + id).style.display = 'none';
    }
    function hideScoreEditForm(id) {
        document.getElementById('score-edit-form-' + id).style.display = 'none';
        document.getElementById('score-row-' + id).style.display = '';
    }
</script>
@endsection