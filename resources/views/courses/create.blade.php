@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Add New Course</h1>
    <form action="{{ route('courses.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block text-gray-700">Course Name</label>
            <input type="text" name="name" id="name" class="w-full p-2 border rounded-md" required>
        </div>
        <div>
            <label for="credits" class="block text-gray-700">Credits</label>
            <input type="number" name="credits" id="credits" class="w-full p-2 border rounded-md" min="1" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Add Course</button>
    </form>

    <!-- error handling -->

    @if (session('error'))
        <div id="error-alert" class="bg-red-100 border-l-4 mt-5 border-red-500 text-red-700 p-4 mb-4" role="alert">
            {{ session('error') }}
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
