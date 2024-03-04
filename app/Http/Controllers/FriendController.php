<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();

            // Retrieve the current user's friends with their profiles
            $friends = $user->friends()->with('profile')->get();

            // Friend requests
            $friendRequests = $user->friendRequests()->with('profile')->get();

            // Retrieve other users excluding the current user, along with their profiles
            $otherUsers = User::where('id', '!=', $user->id)->with('profile')->get();

            // Return the view with both friends and other users, including their profiles
            return view('friends.index', compact('friends', 'otherUsers', 'friendRequests'));
        } catch (\Exception $e) {
            // Redirect back with an error message including the exception message
            return back()->with('error', 'An error occurred while retrieving your friends and other users.' . $e->getMessage());
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}