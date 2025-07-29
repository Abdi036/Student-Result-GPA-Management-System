<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student GPA System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('students.index') }}" class="text-xl font-bold text-gray-800">Student GPA System</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('students.create') }}" class="text-gray-600 hover:text-blue-500 font-bold">Add Student</a>
                        <a href="{{ route('courses.create') }}" class="text-gray-600 hover:text-blue-500 font-bold">Add Course</a>
                        <a href="{{ route('scores.create') }}" class="text-gray-600 hover:text-blue-500 font-bold">Add Score</a>
                        <a href="{{ route('courses.index') }}" class="text-gray-600 hover:text-blue-500 font-bold">All Courses</a>
                        <form action="{{ route('signout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-red-500 font-semibold p-2 border-2 border-gray-200 rounded-lg ml-10">Sign Out</button>
                        </form>
                    @else
                        <a href="{{ route('show.login') }}" class="text-gray-600 hover:text-blue-500">Login</a>
                        <a href="{{ route('show.signup') }}" class="text-gray-600 hover:text-blue-500">Signup</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        @if (session('success'))
            <div id="success-alert" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(function() {
                    var alert = document.getElementById('success-alert');
                    if (alert) alert.style.display = 'none';
                }, 3000);
            </script>
        @endif
        @yield('content')
    </div>
</body>
</html>

