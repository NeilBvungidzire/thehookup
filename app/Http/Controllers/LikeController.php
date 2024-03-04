<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Store a new like for a post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $postId
     */
    public function store(Request $request, $postId)
    {

        $userId = Auth::id();

        $post = Post::find($postId);
        if (!$post) {
            return redirect()->back()->with('message', 'Post not found !');
        }

        $existingLike = Like::where('likeable_type', Post::class)
                            ->where('likeable_id', $postId)
                            ->where('user_id', $userId)
                            ->first();

        if ($existingLike) {
            return redirect()->back()->with('message', 'You already liked this post !');
        }

        $like = new Like();
        $like->likeable_type = Post::class;
        $like->likeable_id = $postId;
        $like->user_id = $userId;

        if ($like->save()) {
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors('message', 'Failed to like post !');
        }
    }


    /**
     * Remove a like from a post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $postId
     */
    public function destroy(Request $request, $postId)
    {
        $userId = Auth::id();

        $like = Like::where('likeable_type', Post::class)
                    ->where('likeable_id', $postId)
                    ->where('user_id', $userId)
                    ->first();

        if ($like) {
            $like->delete();
            return redirect()->back()->with('message', 'You have unliked the post.');
        } else {
            return redirect()->back()->with('message', 'Like not found.');
        }
    }
}