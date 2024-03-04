<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        try {
            $formFields = $request->validate([
                'username' => [
                    'required',
                    'min:3',
                    'max:255',
                    Rule::unique('users'),
                ],
                'password' => 'required|min:8|max:255|confirmed',
            ]);

            $formFields['password'] = bcrypt($formFields['password']);
            $formFields['last_active'] = now();

            $user = User::create($formFields);

            auth()->login($user);

            return redirect()->route('feeds.index')->with('message', 'User created and logged in!');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['register' => 'User registration failed!' . $th->getMessage()]);
        }
    }

}