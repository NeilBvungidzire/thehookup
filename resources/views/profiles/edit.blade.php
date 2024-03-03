@extends('components.layout')

@section('content')
    <div class="container mx-auto mt-8 px-4 max-w-md">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">Edit Profile</h1>
            <form action="{{ route('profile.update', $profile) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="first_name" class="block text-gray-700 font-bold mb-2">First Name:</label>
                    <input type="text" name="first_name" id="first_name" value="{{ $profile->first_name }}"
                        class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="last_name" class="block text-gray-700 font-bold mb-2">Last Name:</label>
                    <input type="text" name="last_name" id="last_name" value="{{ $profile->last_name }}"
                        class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="bio" class="block text-gray-700 font-bold mb-2">Bio:</label>
                    <textarea name="bio" id="bio" class="border border-gray-300 rounded-md p-2 w-full">{{ $profile->bio }}</textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update
                        Profile</button>
                </div>
            </form>
        </div>
    </div>
@endsection
