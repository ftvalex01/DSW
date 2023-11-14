<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Verificar si el usuario ha verificado su correo electrónico
            if (!$user->hasVerifiedEmail()) {
                return response()->json(['message' => 'Email not verified. Cannot generate Personal Access Token.'], 403);
            }

            $token = $user->createToken('MyApp')->accessToken;
            return response()->json([
                'message' => 'User logged in successfully.',
                'token' => $token
            ], 200);
        } else {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }
    }
}
