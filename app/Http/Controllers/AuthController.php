<?php

/**
 * Authentication Controller
 * 
 * @package MarieERP
 * @author Group 17
 * @version 1.0.0
 * @created May 2024
 * 
 * This file is part of the MarieERP project, developed for Software Engineering course.
 * 
 * Libraries/Frameworks used:
 * - Laravel Framework (MIT License)
 * - Laravel Sanctum for API authentication
 * 
 * Code Attribution:
 * - Written by: [Your Team Names]
 * - Authentication logic adapted from Laravel's official authentication documentation
 *   Source: https://laravel.com/docs/authentication
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        $token = bin2hex(random_bytes(40));
        $user->update(['token' => $token]);

        return response()->json([
          'token' => $token,
          'user'  => [
            'id'   => $user->id,
            'name' => $user->name,   // ← include it
          ],
        ]);
    }

    return response()->json(['message' => 'Invalid credentials'], 401);
}


public function register(Request $request)
{
    $validated = $request->validate([
      'name'                  => 'required|string|max:255',
      'email'                 => 'required|email|unique:users,email',
      'password'              => 'required|string|min:6|confirmed',
    ]);

    $user = User::create([
      'name'     => $validated['name'],
      'email'    => $validated['email'],
      'password' => Hash::make($validated['password']),
    ]);

    $token = bin2hex(random_bytes(40));
    // you may want to store it on the user record or in a separate table

    return response()->json([
      'token' => $token,
      'user'  => [
        'id'   => $user->id,
        'name' => $user->name,
      ],
    ], 201);
}

}
