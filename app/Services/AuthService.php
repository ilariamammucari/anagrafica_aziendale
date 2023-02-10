<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService{

    public function registerAuthService($name, $email, $password)
    {
        $user = new User();

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ];

        $user->fill($data);
        $user->save();

        $token = $user->createToken('mytoken')->plainTextToken;
        $user->remember_token = $token;

        return $user;
    }

    public function loginAuthService($email, $password){
        $user = User::where('email', $email)->first();

        if( !$user || !Hash::check($password, $user->password) ){
            return response([
                'message' => 'Credenziali errate'
            ], 401);
        }

        $token = $user->createToken('mytoken')->plainTextToken;
        $user->remember_token = $token;

        return $user;
    }

}