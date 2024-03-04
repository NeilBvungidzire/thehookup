@extends('components.layout')

@section('title', 'Feeds')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="flex justify-center">
            <div class="w-full md:w-2/3 lg:w-1/2">
                @foreach ($posts as $post)
                    <div class="bg-white p-4 rounded-lg shadow-lg mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <img src="{{ $post->user->profile_photo_url ?: asset('images/default-profile.png') }}"
                                    alt="{{ $post->user->username }}" class="w-12 h-12 rounded-full mr-3">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900">
                                        @if ($post->user->id === auth()->id())
                                            You
                                        @else
                                            {{ $post->user->username }}
                                        @endif
                                    </h2>
                                    <p class="text-gray-500 text-sm">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-800 text-sm">{{ $post->content }}</p>
                        <div class="mt-4 border-t pt-4">
                            <div class="flex justify-between items-center">
                                <!-- Like/Unlike button -->
                                @php
                                    $userLike = $post->likes->where('user_id', auth()->id())->first();
                                @endphp

                                <div>
                                    @php
                                        $userLike = $post->likes->where('user_id', auth()->id())->first();
                                        $likesCount = $post->likes->count();
                                    @endphp

                                    @if (!$userLike)
                                        <form action="{{ route('likes.store', ['postId' => $post->id]) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="flex items-center space-x-1 text-gray-500 hover:text-blue-600 focus:outline-none">
                                                <i class="far fa-thumbs-up"></i>
                                                <span>Like</span>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('likes.destroy', ['postId' => $post->id]) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="flex items-center space-x-1 text-gray-500 hover:text-red-600 focus:outline-none">
                                                <i class="fas fa-thumbs-up"></i>
                                                <span>Unlike</span>
                                            </button>
                                        </form>
                                    @endif
                                    <span class="ml-2 text-gray-600">{{ $likesCount }}
                                        {{ Str::plural('Like', $likesCount) }}</span>
                                </div>



                                <!-- Comment button -->
                                <button class="flex items-center text-gray-500 hover:text-blue-600"
                                    onclick="toggleCommentForm({{ $post->id }})">
                                    <i class="far fa-comment mr-1"></i> Comment
                                </button>
                            </div>

                            <!-- Comments form (hidden by default) -->
                            <div id="comment-form-{{ $post->id }}" class="hidden mt-4">
                                <form action="{{ route('comments.store', ['commentableId' => $post->id]) }}" method="POST"
                                    class="flex">
                                    @csrf
                                    <input type="text" name="content"
                                        class="flex-1 border rounded-l-lg py-2 px-4 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                                        placeholder="Write a comment...">
                                    <button type="submit"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700">
                                        Post
                                    </button>
                                </form>
                            </div>

                            <!-- Comments display -->
                            @if ($post->comments->isNotEmpty())
                                <div class="mt-4">
                                    @foreach ($post->comments as $comment)
                                        <div class="flex items-start mt-2">
                                            <img src="{{ $comment->user->profile_photo_url ?: asset('images/default-profile.png') }}"
                                                alt="{{ $comment->user->username }}" class="w-8 h-8 rounded-full mr-2">
                                            <div class="bg-gray-100 rounded-lg p-2 flex-1">
                                                <h4 class="text-sm font-semibold">
                                                    @if ($comment->user->id === auth()->id())
                                                        You
                                                    @else
                                                        {{ $comment->user->username }}
                                                    @endif
                                                </h4>
                                                <p class="text-xs text-gray-600">
                                                    {{ $comment->created_at->diffForHumans() }}</p>
                                                <p class="text-sm">{{ $comment->body }}</p>
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
    </div>

    <script>
        function toggleCommentForm(postId) {
            const commentForm = document.getElementById(`comment-form-${postId}`);
            commentForm.classList.toggle('hidden');
        }
    </script>
@endsection
