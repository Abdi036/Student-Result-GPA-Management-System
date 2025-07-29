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
    
    @if ($errors->any())
        <div id="error-alert" class="bg-red-100 border-l-4 mt-5 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <script>
            setTimeout(function() {
                var alert = document.getElementById('error-alert');
                if (alert) {
                    alert.style.display = 'none';
                }
            }, 3000);
        </script>
    @endif
@endsection



