<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function ownerSignup(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'owner',
        ]);

        return response()->json(['message' => 'Owner signed up successfully'], 201);
    }

    public function managerSignup(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'manager',
        ]);

        return response()->json(['message' => 'Manager signed up successfully'], 201);
    }

    public function ownerLogin(Request $request)
{
    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('UserToken', [$user->role])->accessToken;

        return response()->json(['token' => $token, 'role' => $user->role]);
    }

    return response()->json(['error' => 'Unauthorized'], 401);
}

    public function managerLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('UserToken', [$user->role])->accessToken;

            return response()->json(['token' => $token, 'role' => $user->role]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
