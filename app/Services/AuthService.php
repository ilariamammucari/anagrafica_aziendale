<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService{

    public function registerAuthService($fields)
    {
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('mytoken')->plainTextToken;
        $user->remember_token = $token;

        return $user;
    }

    public function loginAuthService($fields){
        $user = User::where('email', $fields['email'])->first();

        if( !$user || !Hash::check($fields['password'], $user->password) ){
            return response([
                'message' => 'Credenziali errate'
            ], 401);
        }

        $token = $user->createToken('mytoken')->plainTextToken;
        $user->remember_token = $token;

        return $user;
    }

}