@extends('layouts.guest')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Full Name -->
        <div>
            <label for="fullname" class="block font-medium text-sm text-gray-700">Full Name</label>
            <input id="fullname" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="fullname" value="{{ old('fullname') }}" required autofocus />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <label for="username" class="block font-medium text-sm text-gray-700">Username</label>
            <input id="username" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="username" value="{{ old('username') }}" required />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
            <input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="email" name="email" value="{{ old('email') }}" required />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
            <input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="password" name="password" required />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirm Password</label>
            <input id="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="password" name="password_confirmation" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <button type="submit" class="ms-4 px-4 py-2 bg-gray-800 text-white rounded-md font-semibold">
                {{ __('Register') }}
            </button>
        </div>
    </form>
@endsection