<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
 public function createAdmin(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'contact_number' => 'required|string|max:15',
        ]);

        $admin = User::create([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'contact_number' => $request->contact_number,
            'role' => 'admin'
        ]);

        return response()->json([
            'message' => 'Admin created successfully',
            'admin' => $admin->only(['id', 'username', 'email', 'role'])
        ], 201);
    }

    // Admin creates a new user for the mobile app
    public function createUser(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'contact_number' => 'required'
        ]);


        $user = User::create([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact_number' => $request->contact_number,
            'role' => 'user' 
        ]);

        return response()->json(['message' => 'User created successfully', 'user' => $user]);
    }

    // List all mobile app users
    public function listUsers()
    {
        $users = User::where('role', 'user')->get();
        return response()->json($users);
    }
}