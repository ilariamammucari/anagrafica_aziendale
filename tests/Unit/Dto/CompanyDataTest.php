<?php

namespace Tests\Unit\Dto;

use App\Dto\CompanyData;
use App\Models\User;
use Tests\TestCase;

class CompanyDataTest extends TestCase
{
    /** @test */
    public function itCreatesDtoWithDefaultValues()
    {
        /** @var User $user */
        $user = User::factory()->make();
        $result = CompanyData::newInstanceFrom($data = $this->companyData(), $user);

        $this->assertEquals($user, $result->creator);
        $this->assertEquals($data['businessName'], $result->businessName);
        $this->assertEquals($data['address'], $result->address);
        $this->assertEquals($data['vat'], $result->vat);
        $this->assertEquals($data['taxCode'], $result->taxCode);
        $this->assertEquals($data['employees'], $result->employees);
        $this->assertEquals($data['active'], $result->active);
        $this->assertEquals($data['type'], $result->type);

        $this->assertEquals($formatted = [
            'business_name' => $data['businessName'],
            'address' => $data['address'],
            'vat' => $data['vat'],
            'tax_code' => $data['taxCode'],
            'employees' => $data['employees'],
            'active' => $data['active'],
            'type' => $data['type']
        ], $result->toArray());

        $this->assertEquals(json_encode($formatted), $result->toJson());
    }
}
