@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Course List</h1>
    <div class="overflow-x-auto">
        <table class="w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 text-left text-gray-600">Name</th>
                    <th class="py-2 px-4 text-left text-gray-600">Credits</th>
                    <th class="py-2 px-4 text-left text-gray-600">Edit</th>
                    <th class="py-2 px-4 text-left text-gray-600">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr class="border-b" id="row-{{ $course->id }}">
                        <td class="py-2 px-4">
                            <span id="name-{{ $course->id }}">{{ $course->name }}</span>
                        </td>
                        <td class="py-2 px-4">
                            <span id="credits-{{ $course->id }}">{{ $course->credits }}</span>
                        </td>
                        <td class="py-2 px-4">
                            <!-- Edit Button -->
                            <button onclick="showEditForm({{ $course->id }})" class="bg-blue-500 text-white px-2 py-1 rounded">Edit</button>
                        </td>
                        <td class="py-2 px-4">
                            <!-- Delete Form -->
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Inline Edit Form (hidden by default) -->
                    <tr id="edit-form-{{ $course->id }}" style="display:none;">
                        <td colspan="3" class="py-2 px-4 bg-gray-100">
                            <form action="{{ route('courses.update', $course->id) }}" method="POST" class="flex space-x-2">
                                @csrf
                                @method('PATCH')
                                <input type="text" name="name" value="{{ $course->name }}" class="border px-2 py-1 rounded">
                                <input type="number" name="credits" value="{{ $course->credits }}" class="border px-2 py-1 rounded" min="1">
                                <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Save</button>
                                <button type="button" onclick="hideEditForm({{ $course->id }})" class="bg-gray-400 text-white px-2 py-1 rounded">Cancel</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function showEditForm(id) {
            document.getElementById('edit-form-' + id).style.display = '';
            document.getElementById('row-' + id).style.display = 'none';
        }
        function hideEditForm(id) {
            document.getElementById('edit-form-' + id).style.display = 'none';
            document.getElementById('row-' + id).style.display = '';
        }
    </script>
@endsection

