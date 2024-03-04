<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        try {
            $formFields = $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            if (auth()->attempt($formFields)) {
                $request->session()->regenerate();
                return redirect()->route('feeds.index')->with('success', 'You are now logged in!');
            } else {
                return redirect()->back()->withErrors(['login' => 'Invalid credentials!']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['login' => 'Login failed!' . $th->getMessage()]);
        }

    }

}