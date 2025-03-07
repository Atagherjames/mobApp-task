<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{

     // Register user
    public function register(Request $request)
    {
        try {
            $request->validate([
                     'full_name' => 'required|min:6',
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
                'contact_number' => $request->contact_number
            ]);

            return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'User registration failed', 'error' => $e->getMessage()], 500);
        }
    }


    // Login
    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            if (!Auth::attempt($request->only('username', 'password'))) {
                return response()->json(['message' => 'Invalid login credentials'], 401);
            }

            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['message' => 'Login successful', 'token' => $token]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Login failed', 'error' => $e->getMessage()], 500);
        }
    }


    // logout
    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Logout successful']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Logout failed', 'error' => $e->getMessage()], 500);
        }
    }

}
