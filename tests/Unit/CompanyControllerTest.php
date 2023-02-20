<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\User;
use App\Services\CompanyService;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_createCompanyService()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'user_id' => Auth::id(),
            'businessName' => $this->faker->company,
            'address' => $this->faker->company,
            'vat' =>  '01234567891',
            'taxCode' => $this->faker->regexify('[A-Z]{6}[0-4]{5}'),
            'employees' => $this->faker->randomNumber(3, false),
            'active' => 1,
            'type' => 1,
        ];

        $company = (new CompanyService)->createCompany($data['user_id'], $data['businessName'], $data['address'], $data['vat'], $data['taxCode'], $data['employees'], $data['active'], $data['type']);

        $this->assertInstanceOf(Company::class, $company);
        $this->assertEquals($data['businessName'], $company->businessName);
        $this->assertEquals($data['address'], $company->address);
        $this->assertEquals($data['vat'], $company->vat);
        $this->assertEquals($data['taxCode'], $company->taxCode);
        $this->assertEquals($data['employees'], $company->employees);
        $this->assertEquals($data['active'], $company->active);
        $this->assertEquals($data['type'], $company->type);
    }

    public function test_showCompanyService(){
        $user = User::factory()->create();
        $this->actingAs($user);
        $company = Company::factory()->create()->toArray();
        $response = (new CompanyService)->showCompanyService($company['id']);
        $this->assertNotEmpty($response);
    }

    public function test_updateCompanyService(){
        $user = User::factory()->create();
        $this->actingAs($user);
        $company = Company::factory()->create();
        $new_address = 'via topolino';
        $response = (new CompanyService)->updateCompanyService(['address' => $new_address], $company);
        $this->assertNotEmpty($response);
        $this->assertEquals($new_address, Company::where('id', $company['id'])->first()->address);
    }

    public function test_destroyCompanyService(){
        $user = User::factory()->create();
        $this->actingAs($user);
        $company = Company::factory()->create();
        (new CompanyService)->destroyCompanyService($company);
        $this->assertEquals(0,Company::all()->count());
    }
}
