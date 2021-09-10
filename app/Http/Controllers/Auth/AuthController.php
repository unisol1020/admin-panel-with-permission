<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterFormRequest $request): JsonResponse
    {
        User::create($request->toArray());

        return response()->json(['message' => 'Created'], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['errors'  => 'Unauthorised'], 401);
        }

        $token = Auth::user()->createToken(config('app.name'));

        $token->token->expires_at = $request->remember_me ? Carbon::now()->addMonth() : Carbon::now()->addDay();

        $token->token->save();

        return response()->json([
            'token_type' => 'Bearer',
            'token'      => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
            'user'       => Auth::user()
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Successfully']);
    }
}
