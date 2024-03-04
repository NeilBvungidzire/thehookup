@extends('components.layout')

@section('title', 'Feeds')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($posts as $post)
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <img src="{{ $post->user->profile_photo_url ?: asset('images/logo-main.png') }}"
                                alt="{{ $post->user->username }}" class="w-10 h-10 rounded-full mr-2">

                            <div>
                                <h2 class="text-lg font-semibold">{{ $post->user->username }}</h2>
                                <p class="text-gray-500 italic font-thin">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                    </div>
                    <p>{{ $post->content }}</p>
                    <div class="mt-4">
                        <div class="flex items-center">
                            <!-- Like button -->
                            <form action="{{ route('likes.store', ['post' => $post->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-gray-500 hover:text-blue-500 mr-4">
                                    {{ $post->likes_count ?? 0 }} <i class="far fa-thumbs-up"></i>
                                </button>
                            </form>


                            <!-- Add comment button -->
                            <button class="text-gray-500 hover:text-blue-500">
                                <i class="far fa-comment"></i> Add Comment
                            </button>
                        </div>
                        <h3 class="text-lg font-semibold"><span
                                class="text-gray-500">{{ $post->comments_count > 0 ? $post->comments_count : 'No comments' }}</span>
                        </h3>
                        @if ($post->comments->isNotEmpty())
                            <div class="space-y-4">
                                @foreach ($post->comments as $comment)
                                    <div class="flex items-center">
                                        <img src="{{ $comment->user->profile_photo_url }}"
                                            alt="{{ $comment->user->username }}" class="w-8 h-8 rounded-full mr-2">
                                        <div>
                                            <h4 class="text-sm font-semibold">{{ $comment->user->username }}</h4>
                                            <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}
                                            </p>
                                            <p class="text-sm">{{ $comment->content }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
