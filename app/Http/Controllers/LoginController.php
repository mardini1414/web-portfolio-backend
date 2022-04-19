<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function store(LoginRequest $request)
    {

        if (Auth::attempt($request->all())) {
            /** @var \App\Models\User $user **/
            $user = Auth::user();
            $token = $user->createToken('userToken')->plainTextToken;
            $data = [
                'token' => $token,
                'token_type' => 'Bearer'
            ];

            return response()->json($data);
        }

        $data = [
            'status' => 401,
            'message' => 'Wrong email or password',
        ];

        return response()->json($data, 401);
    }
}
