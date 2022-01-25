<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Services\Providers\HttpStatus;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $service;

    public function __construct(AuthService $service)
    {
        $this->middleware('auth:sanctum')->except(['login']);
        $this->service = $service;
    }

    public function login(LoginRequest $request)
    {
        return $this->service->login($request->email, $request->password);
    }

    public function logout()
    {
        return $this->service->logout();
    }
}