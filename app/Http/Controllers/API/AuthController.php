<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ResponseAPI;

    public function __construct()
    {
        $this->middleware('auth:api')->except('login');
    }

    public function login(Request $request)
    {
        try {
            $validator = validator($request->only('email', 'password'), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $credentials = $request->only('email', 'password');

            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json([
                    'message' => 'Email or password invalid',
                ], 401);
            }

            auth('api')->user()->getRoleNames();

            return response()->json([
                'message' => 'Login success',
                'data' => [
                    'user' => auth('api')->user(),
                    'access_token' => $token,
                    'token_type' => 'bearer',
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Internal Server Error',
            ], 500);
        }
    }


    public function logout()
    {
        try {
            auth()->guard('api')->logout();
            return $this->success('Logout success', null);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }
}
