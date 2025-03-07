<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Exception;



class AuthController extends Controller
{
    // ADMIN LOGIN
    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->where('role', 'admin')->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid admin credentials'], 401);
        }

        $token = $user->createToken('admin_token')->plainTextToken;

        return response()->json(['message' => 'Admin login successful', 'token' => $token]);
    }

    // ADMIN LOGOUT
    public function adminLogout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Admin logged out successfully']);
    }

    // USER LOGIN (for mobile app users)
    public function userLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->where('role', 'user')->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid user credentials'], 401);
        }

        $token = $user->createToken('user_token')->plainTextToken;

        return response()->json(['message' => 'User login successful', 'token' => $token]);
    }

    // USER LOGOUT
    public function userLogout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'User logged out successfully']);
    }
}