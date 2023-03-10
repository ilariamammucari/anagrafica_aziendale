<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_validation_login_user_email_required(){
        $response = $this->postJson(route('login'), ['email', 'password' => 'password']);

        $response->assertStatus(422)->assertJsonValidationErrors('email');
        $this->assertSame(
            'The email field is required.',
            $response->json('errors.email.0')
        );

    }

    public function test_validation_login_user_password_required(){
        $response = $this->postJson(route('login'), ['email' => 'test@gmail.com', 'password']);

        $response->assertStatus(422)->assertJsonValidationErrors('password');
        $this->assertSame(
            'The password field is required.',
            $response->json('errors.password.0')
        );

    }

    public function test_validation_company_businessName_required(){
        $user = User::factory()->create();

        $company = Company::factory()->create()->toArray();
        $response = $this->actingAs($user)->postJson(route('store'), [
            'businessName',
            'address' => $company['address'],
            'vat' =>  $company['vat'],
            'taxCode' => $company['taxCode'],
            'employees' => $company['employees'],
            'active' => $company['active'],
            'type' => $company['type'],
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors('businessName');
        $this->assertSame(
            'The business name field is required.',
            $response->json('errors.businessName.0')
        );

    }

    public function test_validation_company_address_nullable(){
        $user = User::factory()->create();

        $company = Company::factory()->create()->toArray();
        $response = $this->actingAs($user)->postJson(route('store'), [
            'businessName' => $company['businessName'],
            'address',
            'vat' =>  $company['vat'],
            'taxCode' => $company['taxCode'],
            'employees' => $company['employees'],
            'active' => $company['active'],
            'type' => $company['type'],
        ]);

        $response->assertStatus(201)->assertJsonMissingValidationErrors('address');

    }

    public function test_validation_company_vat_required(){
        $user = User::factory()->create();

        $company = Company::factory()->create()->toArray();
        $response = $this->actingAs($user)->postJson(route('store'), [
            'businessName' => $company['businessName'],
            'address' => $company['address'],
            'vat',
            'taxCode' => $company['taxCode'],
            'employees' => $company['employees'],
            'active' => $company['active'],
            'type' => $company['type'],
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors('vat');
        $this->assertSame(
            'The vat field is required.',
            $response->json('errors.vat.0')
        );

    }

    public function test_validation_company_taxCode_required(){
        $user = User::factory()->create();

        $company = Company::factory()->create()->toArray();
        $response = $this->actingAs($user)->postJson(route('store'), [
            'businessName' => $company['businessName'],
            'address' => $company['address'],
            'vat' =>  $company['vat'],
            'taxCode',
            'employees' => $company['employees'],
            'active' => $company['active'],
            'type' => $company['type'],
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors('taxCode');
        $this->assertSame(
            'The tax code field is required.',
            $response->json('errors.taxCode.0')
        );

    }

    public function test_validation_company_employees_nullable(){
        $user = User::factory()->create();

        $company = Company::factory()->create()->toArray();
        $response = $this->actingAs($user)->postJson(route('store'), [
            'businessName' => $company['businessName'],
            'address' => $company['address'],
            'vat' =>  $company['vat'],
            'taxCode' => $company['taxCode'],
            'employees',
            'active' => $company['active'],
            'type' => $company['type'],
        ]);

        $response->assertStatus(201)->assertJsonMissingValidationErrors('employees');

    }

    public function test_validation_company_active_nullable(){
        $user = User::factory()->create();

        $company = Company::factory()->create()->toArray();
        $response = $this->actingAs($user)->postJson(route('store'), [
            'businessName' => $company['businessName'],
            'address' => $company['address'],
            'vat' =>  $company['vat'],
            'taxCode' => $company['taxCode'],
            'employees' => $company['employees'],
            'active',
            'type' => $company['type'],
        ]);

        $response->assertStatus(201)->assertJsonMissingValidationErrors('active');

    }

    public function test_validation_company_type_required(){
        $user = User::factory()->create();

        $company = Company::factory()->create()->toArray();
        $response = $this->actingAs($user)->postJson(route('store'), [
            'businessName' => $company['businessName'],
            'address' => $company['address'],
            'vat' =>  $company['vat'],
            'taxCode' => $company['taxCode'],
            'employees' => $company['employees'],
            'active' => $company['active'],
            'type',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors('type');
        $this->assertSame(
            'The type field is required.',
            $response->json('errors.type.0')
        );

    }
}