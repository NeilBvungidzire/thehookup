<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();

            $friends = $user->friends()->with('profile')->get();

            $friendRequests = $user->friendRequests()->with('profile')->get();


            $otherUsers = Profile::where('user_id', '!=', $user->id)
                        ->get();

                        // dd($otherUsers);

            return view('friends.index', compact('friends', 'otherUsers', 'friendRequests', 'user'));
        } catch (\Exception $e) {
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