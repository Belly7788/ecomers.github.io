<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Display the registration form
    public function showRegisterForm()
    {
        return view('Pages.Auth.Pages.register');
    }

    // Handle registration form submission
    public function register(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|same:password_cm',
        ]);

        try {
            // Create a new user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Log the user in
            Auth::login($user);

            // Redirect to the dashboard
            return redirect('/')->with('success', 'Registration successful!');

        } catch (\Exception $e) {
            // Handle any errors
            return redirect()->back()->with('message', 'Registration failed. Please try again.');
        }
    }

    // Display the login form
    public function showLoginForm()
    {
        return view('Pages.Auth.Pages.login');
    }

    // Handle login form submission
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'name_email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Determine if the input is an email or username
        $field = filter_var($request->name_email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        // Attempt to log the user in
        if (Auth::attempt([$field => $request->name_email, 'password' => $request->password], $request->has('remember'))) {
            // Redirect to the dashboard
            return redirect('/')->with('success', 'Login successful!');
        }

        // Authentication failed
        return redirect()->back()->with('status', 'Invalid Username or Password');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Logged out successfully!');
    }
}
