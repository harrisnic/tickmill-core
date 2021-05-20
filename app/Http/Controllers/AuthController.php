<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Destroy token
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return response()->json('Logged out', Response::HTTP_OK);
    }

    /**
     * Login admin
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Get user
        $user = User::where('email', $request->email)->first();

        // Check if user exists and password is correct
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json('Wrong credentials', Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken('token')->plainTextToken;
        return response()->json($token, Response::HTTP_CREATED);
    }
}
