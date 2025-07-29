@extends('layouts.app')

@section('content')
    <div class="min-h-[76vh] flex items-center justify-center">
        <div class="p-8 rounded-xl w-full max-w-md mx-auto">
            <h1 class="text-3xl font-bold text-center text-black mb-6">Signup to Create Account</h1>
            <form action="{{ route('signup') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block mb-1 text-gray-700 font-semibold" for="name">Name</label>
                    <input type="text" name="name" id="name" required value="{{ old('name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                </div>
                <div>
                    <label class="block mb-1 text-gray-700 font-semibold" for="email">Email</label>
                    <input type="email" name="email" id="email" required value="{{ old('email') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                </div>
                <div>
                    <label class="block mb-1 text-gray-700 font-semibold" for="password">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                </div>
                <div>
                    <label class="block mb-1 text-gray-700 font-semibold" for="password-confirmation">Password Confirmation</label>
                    <input type="password" name="password_confirmation" id="password-confirmation" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" />
                </div>
                <button type="submit"
                    class="w-full bg-black text-white font-bold py-2 rounded-lg shadow hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-400 transition duration-200">
                    Sign Up
                </button>

                <!-- validation errors -->
                @if ($errors->any())
                    <div class="mt-4 p-7 bg-red-200">
                        <ul class="list-inside text-sm text-red-500">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
            <p class="mt-6 text-center text-gray-600">
                Already have an account?
                <a href="{{ route('show.login') }}" class="text-blue-500 font-semibold hover:underline">Sign In</a>
            </p>
        </div>
    </div>
@endsection

