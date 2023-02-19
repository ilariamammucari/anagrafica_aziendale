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
        $this->assertEquals(0,User::all()->count());
        $user = User::factory()->create();
        $this->assertEquals(1,User::all()->count());
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
        
        $this->assertEquals(0,Company::all()->count());
        
        $company = (new CompanyService)->createCompanyService($data['user_id'], $data['businessName'], $data['address'], $data['vat'], $data['taxCode'], $data['employees'], $data['active'], $data['type']);
        
        $this->assertEquals(1,Company::all()->count());

        $this->assertInstanceOf(Company::class, $company);
        $this->assertEquals($data['businessName'], $company->businessName);
        $this->assertEquals($data['address'], $company->address);
        $this->assertEquals($data['vat'], $company->vat);
        $this->assertEquals($data['taxCode'], $company->taxCode);
        $this->assertEquals($data['employees'], $company->employees);
        $this->assertEquals($data['active'], $company->active);
        $this->assertEquals($data['type'], $company->type);
    }

    public function test_createCompanyService_user_not_auth()
    {
        $this->assertEquals(0,User::all()->count());
        $user = User::factory()->create();
        $this->assertEquals(1,User::all()->count());
        $this->actingAs($user);
        $this->assertAuthenticated();

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
        
        $this->assertEquals(0,Company::all()->count());
        
        $company = (new CompanyService)->createCompanyService($data['user_id'], $data['businessName'], $data['address'], $data['vat'], $data['taxCode'], $data['employees'], $data['active'], $data['type']);
        
        $this->assertEquals(1,Company::all()->count());

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
        $this->assertEquals(0,User::all()->count());
        $user = User::factory()->create();
        $this->assertEquals(1,User::all()->count());
        $this->actingAs($user);
        $this->assertAuthenticated();

        $this->assertEquals(0,Company::all()->count());
        $company = Company::factory()->create()->toArray();
        $this->assertEquals(1,Company::all()->count());
        $response = (new CompanyService)->showCompanyService($company['id']);
        $this->assertNotEmpty($response);
    }

    public function test_updateCompanyService(){
        $this->assertEquals(0,User::all()->count());
        $user = User::factory()->create();
        $this->assertEquals(1,User::all()->count());
        $this->actingAs($user);
        $this->assertAuthenticated();

        $this->assertEquals(0,Company::all()->count());
        $company = Company::factory()->create();
        $this->assertEquals(1,Company::all()->count());

        $new_address = 'via topolino';
        $response = (new CompanyService)->updateCompanyService(['address' => $new_address], $company);
        $this->assertNotEmpty($response);
        $this->assertEquals($new_address, Company::where('id', $company['id'])->first()->address);
    }

    public function test_destroyCompanyService(){
        $this->assertEquals(0,User::all()->count());
        $user = User::factory()->create();
        $this->assertEquals(1,User::all()->count());
        $this->actingAs($user);
        $this->assertAuthenticated();

        $this->assertEquals(0,Company::all()->count());
        $company = Company::factory()->create();
        $this->assertEquals(1,Company::all()->count());
        (new CompanyService)->destroyCompanyService($company);
        $this->assertEquals(0,Company::all()->count());
    }
}
