@extends('components.layout')

@section('content')
    <div class="container mx-auto mt-8 max-w-md px-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">Profile</h1>
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                    <img src="{{ $profile->image ? $profile->image->url : 'images/logo-main.png' }}" alt="Profile Image">
                </div>
                <div>
                    <p class="font-bold">{{ $profile->first_name }} {{ $profile->last_name }}</p>
                    <p class="text-gray-500">{{ ucfirst($profile->gender) }}</p>
                </div>
            </div>
            <div class="mb-4">
                <p><span class="font-bold">Date of Birth:</span>
                    {{ $profile->date_of_birth ? \Carbon\Carbon::parse($profile->date_of_birth)->format('Y-m-d') : '-' }}
                </p>
            </div>
            <div class="mb-4">
                <p><span class="font-bold">Bio:</span> {{ $profile->bio ? $profile->bio : '-' }}</p>
            </div>
            <div class="mb-4">
                <p><span class="font-bold">Friend Count:</span> {{ $friendCount }}</p>
            </div>
            <div class="mb-4">
                <p><span class="font-bold">Pending Friend Requests:</span> {{ $pendingFriendRequestsCount }}</p>
            </div>
            <div class="mb-4">
                <p><span class="font-bold">Notifications:</span> {{ $notificationsCount }}</p>
            </div>
            <div class="mt-8 flex justify-end">
                <a href="{{ route('profile.edit', $profile) }}" class="text-blue-500 hover:text-blue-700 mr-4">Edit</a>
                <!-- Add delete functionality if needed -->
            </div>
        </div>
    </div>
@endsection
