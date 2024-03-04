<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
  /**
 * Store a newly created comment in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $postId
 */
public function store(Request $request, $postId)
{
    try {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->commentable_type = 'App\Models\Post';
        $comment->commentable_id = $postId;
        $comment->body = $request->input('content');
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to add comment: ' . $e->getMessage())->withInput();
    }
}

}