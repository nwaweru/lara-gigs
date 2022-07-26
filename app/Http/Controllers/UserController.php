<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show create form
    public function create() {
        return view('users.create');
    }

    // Save user data
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        auth()->login($user);

        return redirect()->route('home')->with('message', 'User created and logged in.');
    }

    // Show login form
    public function showLoginForm() {
        return view('users.login');
    }

    // Log in a user
    public function login(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect()->route('home')->with('message', 'Logged in successfully.');
        }

        return redirect()->back()->withErrors([
            'email' => 'Invalid credentials'
        ])->onlyInput('email');
    }

    // Logout user
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('message', 'User logged out successfully.');
    }
}
