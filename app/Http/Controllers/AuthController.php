<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }

    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        return $this->authService->registerAuthService($fields);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required|string'
        ]);

        return $this->authService->loginAuthService($fields);
    }
}
