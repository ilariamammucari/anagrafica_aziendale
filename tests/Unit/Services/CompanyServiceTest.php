<?php

namespace Tests\Unit\Services;

use App\Dto\CompanyData;
use App\Models\User;
use App\Services\CompanyService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function itCreatesCompanyFromDto()
    {
        $this->assertDatabaseCount('companies', 0);

        /** @var User $user */
        $user = User::factory()->create();
        $dto = CompanyData::newInstanceFrom($this->companyData(), $user);

        $service = new CompanyService();
        $result = $service->createCompany($dto);

        $this->assertDatabaseCount('companies', 1);
        $this->assertDatabaseHas('companies', [
            'user_id' => $user->getKey(),
            'business_name' => $result->business_name,
            'address' => $result->address,
            'vat' => $result->vat,
            'tax_code' => $result->tax_code,
            'employees' => $result->employees,
            'active' => $result->active,
            'type' => $result->type
        ]);
    }
}
