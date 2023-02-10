<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;

class AuthController extends Controller
{
    public $authService;
    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }

    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        return new UserResource($this->authService->registerAuthService($fields['name'], $fields['email'], $fields['password']));
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required|string'
        ]);

        return new UserResource($this->authService->loginAuthService($fields['email'], $fields['password']));
    }
}
