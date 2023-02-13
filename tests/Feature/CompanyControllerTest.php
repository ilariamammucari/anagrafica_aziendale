<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_user_can_access_index_route()
    {
        $response = $this->get('/api/companies');

        $response->assertStatus(200);
    }

    public function test_auth_user_can_access_store_route()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);

        $response = $this->post('/api/companies', Company::factory()->create()->toArray());

        $response->assertStatus(201);
    }

    public function test_auth_user_can_access_show_route()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);

        $company = Company::factory()->create()->toArray();
        $response = $this->get('/api/companies/' . $company['id']);

        $response->assertStatus(200);
    }

    public function test_auth_user_can_access_update_route()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);

        $company = Company::factory()->create()->toArray();
        $response = $this->patch('/api/companies/' . $company['id'], [
            'address' => 'via paperino 45'
        ]);

        $response->assertStatus(200);
    }

    public function test_auth_user_can_access_destroy_route()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);

        $company = Company::factory()->create()->toArray();
        $response = $this->delete('/api/companies/' . $company['id']);

        $response->assertStatus(204);
    }
}
