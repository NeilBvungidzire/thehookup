@extends('components.layout')

@section('title', 'Feeds')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="flex justify-center">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($posts as $post)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <img src="{{ $post->user->profile_photo_url ?: asset('images/logo-main.png') }}"
                                    alt="{{ $post->user->username }}" class="w-10 h-10 rounded-full mr-2">

                                <div>
                                    <h2 class="text-lg font-semibold">
                                        @if ($post->user->id === auth()->id())
                                            You
                                        @else
                                            {{ $post->user->username }}
                                        @endif
                                    </h2>
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

                                <!-- Add Comment button -->
                                <button class="text-gray-500 hover:text-blue-500"
                                    onclick="toggleCommentForm({{ $post->id }})">
                                    <i class="far fa-comment"></i> Add Comment
                                </button>
                            </div>
                            <div id="comment-form-{{ $post->id }}" class="hidden mt-4">
                                <form action="{{ route('comments.store', ['commentableId' => $post->id]) }}" method="POST"
                                    class="flex mt-4">
                                    @csrf
                                    <input type="text" name="content"
                                        class="flex-1 border rounded-l-md py-2 px-3 focus:outline-none focus:border-blue-500"
                                        placeholder="Write a comment...">
                                    <button type="submit"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </form>

                            </div>
                            <h3 class="text-lg font-semibold pt-2 pb-2">
                                <span class="text-gray-500">
                                    <span class="font-bold">{{ $post->comments->count() ?: 'No' }}</span>
                                    comment{{ $post->comments->count() !== 1 ? 's' : '' }}
                                </span>
                            </h3>


                            @if ($post->comments->isNotEmpty())
                                <div class="space-y-4">
                                    @foreach ($post->comments as $comment)
                                        <div class="flex items-center">
                                            <img src="{{ $post->user->profile_photo_url ?: asset('images/logo-main.png') }}"
                                                alt="{{ $post->user->username }}" class="w-10 h-10 rounded-full mr-2">
                                            <div>
                                                <h4 class="text-sm font-semibold">{{ $comment->user->username }}</h4>
                                                <p class="text-xs text-gray-500">
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
