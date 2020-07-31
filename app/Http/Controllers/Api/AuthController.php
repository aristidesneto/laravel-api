<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validateData['password'] = bcrypt($request->password);

        $user = User::create($validateData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'access_token' => $accessToken
        ], 200);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response([
            'access_token' => $accessToken
        ], 200);

    }

    public function logout(Request $request)
    {
        $token = $request->user()->token()->revoke();

        if ($token) {
            return response([
                'message' => 'You have been succesfully logged out!'
            ], 200);
        }

        return response([
            'message' => 'Error to execute logoff!'
        ], 422);
    }
}
