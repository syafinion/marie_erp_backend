<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = bin2hex(random_bytes(40));  // Generate a token
            $user->update(['token' => $token]);

            return response()->json(['token' => $token, 'userId' => $user->id]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
