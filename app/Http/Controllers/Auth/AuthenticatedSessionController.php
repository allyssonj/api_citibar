<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $request->user()->tokens()->delete();

        $token = $request->user()->createToken(auth()->user()->name);

        return response()->json([
            'user' => $request->user(),
            'token' => $token->plainTextToken
        ]);
    }

    public function destroy(Request $request): Response
    {
        $request->user()->tokens()->delete();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
