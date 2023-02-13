<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\AuthService;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_registerAuthService(){
        $new_user = User::factory()->make();
        $user = (new AuthService)->registerAuthService($new_user['name'], $new_user['email'], $new_user['password']);
        $this->assertNotEmpty($user);
    }

    public function test_loginAuthService(){
        $user = User::factory()->create()->toArray();
        $response = (new AuthService)->loginAuthService($user['email'], 'password');
        $this->assertNotEmpty($response);
    }
}
