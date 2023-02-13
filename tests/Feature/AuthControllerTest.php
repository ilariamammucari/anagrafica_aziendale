<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_register()
    {
        $user = User::factory()->create()->toArray();
        $response = $this->post('/api/register', $user);

        $response->assertStatus(302)->assertRedirect('/');
        $this->assertEquals(1,User::all()->count());
    }

    public function test_login()
    {
        $user = User::factory()->create()->toArray();
        $response = $this->post('/api/login', [
            'email' => $user['email'],
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }
}
