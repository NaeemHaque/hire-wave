<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($attributes)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Your provided credentials do not match. ',
            ]);
        }

        session()->regenerate();

        return redirect('/')->with('success', 'Welcome Back!');
    }

    public function destroy(string $id)
    {
        Auth::logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
