<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public $authService;
    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request){
        $request->validated();
        return new UserResource($this->authService->registerAuthService($request['name'], $request['email'], $request['password']));
    }

    public function login(LoginRequest $request){
        $request->validated();
        return new UserResource($this->authService->loginAuthService($request['email'], $request['password']));
    }
}
