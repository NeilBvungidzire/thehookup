@extends('components.layout')

@section('content')
    <div class="container mx-auto mt-8 mb-8 max-w-md px-4">
        <form action="/profile/store" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                    class="border border-gray-300 rounded-md p-2 w-full" placeholder="First Name">
                @error('first_name')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                    class="border border-gray-300 rounded-md p-2 w-full" placeholder="Last Name">
                @error('last_name')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <select name="gender" id="gender" class="border border-gray-300 rounded-md p-2 w-full"
                    placeholder="Select Gender">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}"
                    class="border border-gray-300 rounded-md p-2 w-full" placeholder="Date of Birth">
                @error('date_of_birth')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <textarea name="bio" id="bio" class="border border-gray-300 rounded-md p-2 w-full" rows="4"
                    placeholder="Bio">{{ old('bio') }}</textarea>
                @error('bio')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Create
                    Profile</button>
            </div>
        </form>
    </div>
@endsection
