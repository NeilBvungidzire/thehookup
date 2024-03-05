@extends('components.layout')

@section('content')
    <div class="container mx-auto my-8">
        <div class="flex">
            <div class="w-1/5 px-4 bg-gray-100">
                <h3 class="font-bold text-xl mb-4">Your HookUps</h3>
                <ul>
                    @forelse ($friends as $friend)
                        <li class="mb-2">
                            <div class="flex items-center">
                                <img src="{{ $friend->profile->image->url ?? asset('images/logo-main.png') }}"
                                    alt="{{ $friend->username }}" class="h-10 w-10 rounded-full mr-2">
                                <span>{{ $friend->profile->first_name }} {{ $friend->profile->last_name }}</span>
                            </div>
                        </li>
                    @empty
                        <li>You have no hookups yet.</li>
                    @endforelse
                </ul>
            </div>

            <!-- Main Content for People You May Know -->
            <div class="w-3/5 px-4">
                <div class="flex justify-center items-center col-span-3">
                    <h2 class="text-xl font-bold mb-4">Hookups you may know</h2>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    @forelse($otherUsers as $otherUser)
                        <div class="bg-white rounded-lg overflow-hidden shadow-md">
                            <img src="{{ $otherUser->image->url ?? asset('images/default-profile.png') }}"
                                alt="{{ $otherUser->username }}" class="w-full h-40 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold">{{ $otherUser->first_name }}
                                    {{ $otherUser->last_name }}</h3>
                                <p>{{ $otherUser->bio }}</p>
                                <div class="mt-2">
                                    <span>{{ $user->friends()->count() }} mutual friends</span>
                                </div>
                                <div class="flex justify-between items-center mt-4">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">HookUp
                                    </button>
                                    <button
                                        class="bg-transparent hover:bg-gray-200 text-blue-700 font-semibold py-2 px-4 border border-blue-500 rounded">Remove</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="flex justify-center items-center col-span-3">
                            <p>Congratulations! You're the the first to join TheHookUp!</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <!-- Right Sidebar for Friend Requests -->
            <div class="w-1/5 px-4 bg-gray-100">
                <h3 class="font-bold text-xl mb-4">HookUp Requests</h3>
                <ul>
                    @forelse ($friendRequests as $friendRequest)
                        <li class="mb-2">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img src="{{ $friendRequest->fromUser->profile->image->url ?? asset('images/default-profile.png') }}"
                                        alt="{{ $friendRequest->fromUser->username }}" class="h-10 w-10 rounded-full mr-2">
                                    <span>{{ $friendRequest->fromUser->profile->first_name }}
                                        {{ $friendRequest->fromUser->profile->last_name }}</span>
                                </div>
                                <div>
                                    <button
                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-xs">Accept</button>
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs">Decline</button>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li>No hookup requests.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
