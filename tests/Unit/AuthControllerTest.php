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
        $this->assertEquals(0,User::all()->count());
        $new_user = User::factory()->make();
        $response = (new AuthService)->registerAuthService($new_user['name'], $new_user['email'], $new_user['password']);
        $this->assertEquals(1,User::all()->count());
        $this->assertNotEmpty($response);
        $this->assertEquals($response->name, $new_user->name);
        $this->assertEquals($response->email, $new_user->email);
    }

    public function test_loginAuthService(){
        $user = User::factory()->create()->toArray();
        $response = (new AuthService)->loginAuthService($user['email'], 'password');
        $this->assertNotEmpty($response);
        $this->assertNull($response->original);
    }

    public function test_loginAuthService_wrong_credentials(){
        $user = User::factory()->create()->toArray();
        $response = (new AuthService)->loginAuthService($user['email'], 'passwordErrata');
        $this->assertEquals($response->original['message'],'Credenziali errate');
    }
}
