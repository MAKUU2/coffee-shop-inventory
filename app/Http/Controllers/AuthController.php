<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show Register Page
     */
    public function showRegister()
    {
        return view('auth.register');
    }


    /**
     * Process Registration
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:admins,username',
            'password' => 'required|string|min:6|confirmed',
        ]);


        Admin::create([
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'] ?? null,
            'last_name' => $validated['last_name'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
        ]);


        return redirect()
            ->route('login')
            ->with(
                'success',
                'Admin account created successfully! Please login.'
            );
    }


    /**
     * Show Login Page
     */
    public function showLogin()
    {
        return view('auth.login');
    }


    /**
     * Process Login
     */
    public function login(Request $request)
    {
        // Validate login form
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);


        // Find admin by username
        $admin = Admin::where(
            'username',
            $credentials['username']
        )->first();


        // Check username and password
        if (
            !$admin ||
            !Hash::check(
                $credentials['password'],
                $admin->password
            )
        ) {
            return back()
                ->withErrors([
                    'username' => 'Invalid username or password.',
                ])
                ->onlyInput('username');
        }


        // Store admin information in session
        $request->session()->regenerate();

        session([
            'admin_id' => $admin->id,
            'admin_username' => $admin->username,
            'admin_name' => $admin->first_name . ' ' . $admin->last_name,
            'admin_role' => $admin->role,
        ]);


        // Redirect to dashboard
        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Welcome back, ' . $admin->first_name . '!'
            );
    }


    /**
     * Logout
     */
    public function logout(Request $request)
    {
        // Remove login session
        $request->session()->forget([
            'admin_id',
            'admin_username',
            'admin_name',
            'admin_role',
        ]);


        // Regenerate session
        $request->session()->regenerateToken();


        // Redirect to login
        return redirect()
            ->route('login')
            ->with(
                'success',
                'You have been logged out successfully.'
            );
    }
}
