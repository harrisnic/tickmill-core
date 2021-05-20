<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * Destroy token
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return response()->json('Logged out', Response::HTTP_OK);
    }
}
