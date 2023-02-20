<?php

namespace Tests\Feature\Company;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyStoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticatedUserIsNotAuthorized() // I declare tests in this way... But your way is right too... There's no standard
    {
        $response = $this->postJson(route('company.store'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function authenticatedUserIsAuthorized()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson(route('company.store'));

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'businessName', 'vat', 'taxCode', 'type'
        ]);
    }

    /**
     * @test
     * @dataProvider businessName
     * @dataProvider address
     * @dataProvider vat
     * @dataProvider taxCode
     * @dataProvider employees
     * @dataProvider active
     * @dataProvider type
     */
    public function requestMustBeValid(string $input, mixed $value)
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson(route('company.store'), [$input => $value]);
        $response->assertJsonValidationErrors([$input]);
    }

    /** @test */
    public function requestSucceed()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson(route('company.store'), $this->companyData());

        $response->assertCreated();
        $response->assertJsonStructure([
            'data' => [
                'businessName',
                'address',
                'vat',
                'taxCode',
                'employees',
                'active',
                'type',
                'creator' => [
                    'name', 'email'
                ]
            ]
        ]);
    }

    public function businessName(): array
    {
        return [
            ['businessName', null],
            ['businessName', 1],
            ['businessName', true],
            ['businessName', false],
            ['businessName', 'aa'],
            ['businessName', 'This is a long string... so long that will exceed the maximum characters length for the current request. The string, that should be shorter than two hundred and fifty five characters, won\'t pass the validation and if it does the system will throw an error.'],
            ['businessName', ['foo', 'bar']],
        ];
    }

    public function address(): array
    {
        return [
            ['address', 1],
            ['address', true],
            ['address', false],
            ['address', 'aa'],
            ['address', 'This is a long string... so long that will exceed the maximum characters length for the current request. The string, that should be shorter than two hundred and fifty five characters, won\'t pass the validation and if it does the system will throw an error.'],
            ['address', ['foo', 'bar']],
        ];
    }

    public function vat(): array
    {
        return [
            ['vat', null],
            ['vat', 1],
            ['vat', true],
            ['vat', false],
            ['vat', 'X'],
            ['vat', 'XXXXXXXXXXXX'],
            ['vat', ['foo', 'bar']],
        ];
    }

    public function taxCode(): array
    {
        return [
            ['taxCode', null],
            ['taxCode', 1],
            ['taxCode', true],
            ['taxCode', false],
            ['taxCode', 'X'],
            ['taxCode', 'XXXXXXXXXXXXXXXXX'],
            ['taxCode', ['foo', 'bar']],
        ];
    }

    public function employees(): array
    {
        return [
            ['employees', 'foo'],
            ['employees', 1.1],
            ['employees', ['foo', 'bar']],
        ];
    }

    public function active(): array
    {
        return [
            ['active', null],
            ['active', 'foo'],
            ['active', ['foo', 'bar']],
        ];
    }

    public function type(): array
    {
        return [
            ['type', null],
            ['type', 'foo'],
            ['type', 1.1],
            ['type', ['foo', 'bar']],
        ];
    }
}
