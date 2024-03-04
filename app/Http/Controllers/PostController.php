<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::with('user', 'likes', 'comments')->latest()->get();
            return view('posts.index', compact('posts'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load posts: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'content' => 'required|string|max:255',
            ]);

            $post = new Post();
            $post->user_id = Auth::id();
            $post->content = $request->input('content');
            $post->save();

            return redirect()->route('feeds.index')->with('success', 'Post created successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to store post: ' . $e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete post: ' . $e->getMessage());
        }
    }

    public function hide($id)
    {
        try {
            $post = Post::findOrFail($id);
            return redirect()->route('posts.index')->with('success', 'Post hidden successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to hide post: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $post = Post::with('user', 'likes', 'comments')->findOrFail($id);
            return view('posts.show', compact('post'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to show post: ' . $e->getMessage());
        }
    }

}