<?php

namespace App\Http\Controllers;

use App\Services\AuthenticationService;
use Illuminate\Http\Request;
use Throwable;

class AuthenticationController extends Controller
{
    protected $authenticationService;
    public function __construct()
    {
        $this->authenticationService = new AuthenticationService();
    }

    public function login(Request $request)
    {
        try{
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $result = $this->authenticationService->attempt_login($request);

            if(!$result['success']){
                return response()->json($result, 401);
            }

            return response()->json($result, 200);
        }catch(Throwable $e){
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
            ], 500);
        }

    }

    public function register(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email:dns|unique:users,email',
                'password' => 'required|min:8|confirmed',
            ]);

            $result = $this->authenticationService->store_user($request);

            return response()->json([
                'success' => true,
                'message' => 'Register successfull',
                'data' => $result,
            ], 201);
        }catch(Throwable $e){
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
            ], 500);
        }
    }
}
