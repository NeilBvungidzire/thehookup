@extends('components.layout')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">{{ $userProfile->name }}</h1>
            <p><strong>Email:</strong> {{ $userProfile->email }}</p>
            <p><strong>Phone:</strong> {{ $userProfile->phone }}</p>
            <p><strong>User:</strong> {{ $userProfile->user->name }}</p>
            <p><strong>Created At:</strong> {{ $userProfile->created_at }}</p>
            <p><strong>Updated At:</strong> {{ $userProfile->updated_at }}</p>
            <br />
            <!-- Edit Button -->
            <a href="/profile/edit/{{ $userProfile->id }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Edit</a>

            <!-- Delete Button -->
            <form action="/profile/delete/{{ $userProfile->id }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete</button>
            </form>
        </div>
    </div>
@endsection
