<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Load the profile if it exists
        $profile = $user->profile;

        // Check if the user has a profile
        if (!$profile) {
            // If the user doesn't have a profile, redirect them to create one
            return redirect()->route('profile.create');
        }

        // Count the number of friends
        $friendCount = $user->friends()->count();

        // Get the total number of pending friend requests
        $pendingFriendRequestsCount = $user->friendRequests()->count();

        // Get the total number of notifications for the user
        $notificationsCount = $user->notifications()->count();

        // Pass the user's profile, friend count, pending friend requests count, and notifications count to the view
        return view('profiles.index', [
            'profile' => $profile,
            'friendCount' => $friendCount,
            'pendingFriendRequestsCount' => $pendingFriendRequestsCount,
            'notificationsCount' => $notificationsCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::doesntHave('profile')->get();
        return view('profiles.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();

        $formFields = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'bio' => 'nullable|string',
        ]);

        $formFields['user_id'] = $user_id;

        Profile::create($formFields);
        return redirect()->route('profile.index')->with('success', 'Profile created successfully!');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userProfile = Profile::findOrFail($id);
        return view('profiles.show', compact('userProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $profile = Profile::findOrFail($id);
        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        // Update the profile with the validated data
        $profile->update($validatedData);

        // Redirect back to the profile page with a success message
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       Profile::findOrFail($id)->delete();
       return redirect('/')->with('success', 'Profile deleted successfully!');
    }
}