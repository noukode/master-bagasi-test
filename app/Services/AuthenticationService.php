<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationServices
{
    public function attempt_login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if(!$token = auth('api')->attempt($credentials)){
            return [
                'success' => false,
                'message' => 'email/password doesn\'t match',
            ];
        }

        return $this->respondWithToken($token);
    }

    public function store_user(Request $request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    }

    protected function respondWithToken($token)
    {
        return [
            'success' => true,
            'message' => 'Login successfull',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'refresh_token' => $this->createRefreshToken(),
            'user' => Auth::user(),
        ];
    }

    protected function createRefreshToken()
    {
        $user = Auth::user();
        return JWTAuth::fromUser($user, ['type' => 'refresh']);
    }

}
