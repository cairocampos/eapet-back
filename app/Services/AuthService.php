<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    public function login(string $email, string $password)
    {
        if(!Auth::attempt(["email" => $email, "password" => $password])) {
            return response()->json([
                "message" => "Credenciais inválidas!"
            ], Response::HTTP_FORBIDDEN);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "user" => $user,
            "token" => $token
        ]);
    }

    public function logout()
    {
        try {
            auth()->user()->tokens()->where('name', 'auth_token')->delete();
            return response()->json(['messase' => 'success'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return makeException($e);
        }
    }
}
